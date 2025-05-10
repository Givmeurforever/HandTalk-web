<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PenggunaController extends Controller
{
    /**
     * Menampilkan daftar pengguna
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Query dasar untuk mendapatkan semua pengguna
        $query = User::query();
        
        // Filter berdasarkan pencarian jika ada
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }
        
        // Ambil data dengan pagination (10 item per halaman)
        $users = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // Kembalikan view dengan data users
        return view('admin.pengguna.index', compact('users'));
    }

    /**
     * Menyimpan pengguna baru
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'required|boolean',
        ]);

        // Buat pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'is_admin' => $request->is_admin,
            'status' => 'active',
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil ditambahkan');
    }

    /**
     * Memperbarui data pengguna
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Cari pengguna yang akan diupdate
        $user = User::findOrFail($id);
        
        // Validasi data input
        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'is_admin' => 'required|boolean',
        ];
        
        // Jika password diisi, validasi juga password
        if ($request->filled('password')) {
            $rules['password'] = 'string|min:8|confirmed';
        }
        
        $request->validate($rules);
        
        // Perbarui data pengguna
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->is_admin = $request->is_admin;
        
        // Update password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();
        
        // Redirect dengan pesan sukses
        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Data pengguna berhasil diperbarui');
    }

    /**
     * Menghapus pengguna
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Cari dan hapus pengguna
        $user = User::findOrFail($id);
        $user->delete();
        
        // Redirect dengan pesan sukses
        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil dihapus');
    }

    /**
     * Mengubah status pengguna (aktif/nonaktif)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'status' => 'required|in:active,inactive',
        ]);
        
        // Cari dan update status pengguna
        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();
        
        // Pesan yang akan ditampilkan
        $message = $request->status == 'active' 
            ? 'Pengguna berhasil diaktifkan' 
            : 'Pengguna berhasil dinonaktifkan';
        
        // Redirect dengan pesan sukses
        return redirect()->route('admin.pengguna.index')
            ->with('success', $message);
    }
        public function create()
    {
        return view('admin.pengguna.create');
    }
        public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.pengguna.edit', compact('user'));
    }

}