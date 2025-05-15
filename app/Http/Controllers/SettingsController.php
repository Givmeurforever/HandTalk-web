<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

class SettingsController extends Controller
{
    public function index()
    {
        return view('pages.settings');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Validate input data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'current_password' => 'nullable|required_with:password',
            'password' => [
                'nullable',
                'confirmed',
                Password::defaults(),
                'different:current_password'
            ],
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Check current password if trying to update password
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors([
                    'current_password' => 'The current password is incorrect.'
                ])->withInput();
            }
        }

        // Prepare data to update
        $dataToUpdate = [
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'updated_at' => now()
        ];
        
        // Update password if provided
        if ($request->filled('password')) {
            $dataToUpdate['password'] = Hash::make($validatedData['password']);
        }
        
        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete previous profile picture if exists and not the default
            if ($user->profile_picture && !str_contains($user->profile_picture, 'profile_pictures/default.png')) {
                if (Storage::disk('public')->exists($user->profile_picture)) {
                    Storage::disk('public')->delete($user->profile_picture);
                }
            }
            
            // Store new profile picture
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $dataToUpdate['profile_picture'] = $path;
        }
        
        // Update user data using query builder
        DB::table('users')->where('id', $user->id)->update($dataToUpdate);
        
        return redirect()->route('settings.index')
            ->with('success', 'Your profile has been updated successfully!');
    }

    public function deleteAccount()
    {
        $user = Auth::user();
        
        // Delete profile picture if exists and not the default
        if ($user->profile_picture && !str_contains($user->profile_picture, 'profile_pictures/default.png')) {
            if (Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
        }
        
        // Get user ID before logout
        $userId = $user->id;
        
        // Log the user out
        Auth::logout();
        
        // Delete the user using query builder
        DB::table('users')->where('id', $userId)->delete();
        
        // Redirect to home page with message
        return redirect()->route('home')
            ->with('success', 'Your account has been successfully deleted.');
    }
}