<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        
        // Calculate stats
        $totalUsers = User::count();
        $activeUsers = User::whereNotNull('last_activity')->where('last_activity', '>', now()->subDays(30))->count();
        $newUsers = User::where('created_at', '>', now()->subDays(7))->count();
        
        // Calculate average progress (assuming you have a progress tracking system)
        // This is a placeholder - you'll need to adjust based on your actual progress tracking logic
        $averageProgress = 67; // Placeholder value
        
        return view('admin.pengguna.index', compact('users', 'totalUsers', 'activeUsers', 'newUsers', 'averageProgress'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('admin.pengguna.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|max:2048', // 2MB Max
        ]);

        $user = new User();
        $user->first_name = $validated['first_name'];
        $user->last_name = $validated['last_name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $filename = time() . '.' . $profilePicture->getClientOriginalExtension();
            $path = $profilePicture->storeAs('profile_pictures', $filename, 'public');
            $user->profile_picture = $path;
        }

        $user->save();

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil ditambahkan!');
    }

    /**
     * Display the specified user.
     */
    public function show(User $pengguna)
    {
        // Load additional data related to user progress
        // This is a placeholder - adjust based on your actual data structure
        
        return view('admin.pengguna.show', compact('pengguna'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $pengguna)
    {
        return view('admin.pengguna.edit', compact('pengguna'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $pengguna)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($pengguna->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|max:2048', // 2MB Max
        ]);

        $pengguna->first_name = $validated['first_name'];
        $pengguna->last_name = $validated['last_name'];
        $pengguna->email = $validated['email'];

        // Update password only if provided
        if (!empty($validated['password'])) {
            $pengguna->password = Hash::make($validated['password']);
        }

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old picture if not default
            if ($pengguna->profile_picture != 'profile_pictures/default.png') {
                Storage::disk('public')->delete($pengguna->profile_picture);
            }
            
            $profilePicture = $request->file('profile_picture');
            $filename = time() . '.' . $profilePicture->getClientOriginalExtension();
            $path = $profilePicture->storeAs('profile_pictures', $filename, 'public');
            $pengguna->profile_picture = $path;
        }

        $pengguna->save();

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil diperbarui!');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $pengguna)
    {
        // Delete profile picture if not default
        if ($pengguna->profile_picture != 'profile_pictures/default.png') {
            Storage::disk('public')->delete($pengguna->profile_picture);
        }
        
        $pengguna->delete();

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil dihapus!');
    }
    
    /**
     * Search users by name or email
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $users = User::where('first_name', 'like', "%{$query}%")
            ->orWhere('last_name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->paginate(10);
            
        return response()->json([
            'users' => $users,
            'pagination' => (string) $users->links()
        ]);
    }
    
    /**
     * Filter users by status
     */
    public function filter(Request $request)
    {
        $status = $request->input('status');
        
        if ($status == 'active') {
            $users = User::whereNotNull('last_activity')
                ->where('last_activity', '>', now()->subDays(30))
                ->paginate(10);
        } elseif ($status == 'inactive') {
            $users = User::where(function($query) {
                $query->whereNull('last_activity')
                    ->orWhere('last_activity', '<=', now()->subDays(30));
            })->paginate(10);
        } else {
            $users = User::paginate(10);
        }
        
        return response()->json([
            'users' => $users,
            'pagination' => (string) $users->links()
        ]);
    }
}