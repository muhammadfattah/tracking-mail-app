<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'title' => 'Manajemen User',
            'users' => User::all()
        ]);
    }
    public function create()
    {
        return view('admin.create-user', [
            'title' => 'Tambah User',
        ]);
    }

    public function store(Request $request)
    {
        if (!$request->validate([
            'nama'     => 'required',
            'username' => 'required|unique:user,username',
            'pass'     => 'required',
            'role'     => 'required',
        ])) {
            return back()->withInput();
        } else {
            User::create([
                'nama'      => $request->nama,
                'username'  => strtolower($request->username),
                'password'  => Hash::make($request->pass),
                'is_active' => 1,
                'gambar'    => 'undraw_profile.svg',
                'role'      => $request->role
            ]);

            return redirect()->to(url('user'))->with('message', [
                'icon'  => 'success',
                'title' => 'User baru',
                'text'  => 'Berhasil ditambahkan!'
            ]);
        }
    }

    public function edit(User $user)
    {
        return view('admin.edit-user', [
            'title' => 'Ubah Data User',
            'user'  => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        if (!$request->validate([
            'nama'     => 'required',
            'pass'     => 'required',
            'role'     => 'required',
        ])) {
            return back()->withInput();
        } else {
            User::where('id', $id)->update([
                'nama'      => $request->nama,
                'password'  => Hash::make($request->pass),
                'role'      => $request->role,
                'is_active' => ($request->is_active ? 1 : 0),
            ]);
            return redirect()->to(url('user'))->with('message', [
                'icon'  => 'success',
                'title' => 'Data user',
                'text'  => 'Berhasil diubah!'
            ]);
        }
    }

    public function destroy($id)
    {
        User::destroy($id);
        return back()->with('message', [
            'icon'  => 'success',
            'title' => 'Data user',
            'text'  => 'Berhasil dihapus!'
        ]);
    }
}
