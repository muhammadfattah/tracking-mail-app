<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.index', [
            'title' => 'Login'
        ]);
    }

    public function login(Request $request)
    {
        if (!$request->validate([
            'username' => 'required',
            'pass'     => 'required'
        ])) {
            return back()->withInput();
        } else {
            $user = User::where('username', strtolower($request->input('username')))->first();
            if (($user) && (Hash::check($request->pass, $user->password))) {
                if ($user->is_active == 1) {
                    session(['user-data' => $user]);
                    switch (session('user-data')->role) {
                        case 'Admin':
                            return redirect()->to(url('user'));
                            break;
                        case 'Eselon 3':
                            return redirect()->to(url('eselon-tiga'));
                            break;
                        case 'Eselon 4':
                            return redirect()->to(url('eselon-empat'));
                            break;
                        case 'Pranata':
                            return redirect()->to(url('pranata'));
                            break;
                        case 'Konseptor':
                            return redirect()->to(url('konseptor'));
                            break;
                    }
                } else {
                    return back()->withInput()->with('message', [
                        'icon'  => 'error',
                        'title' => 'Akun anda',
                        'text'  => 'Dinonaktifkan'
                    ]);
                }
            } else {

                return back()->withInput()->with('message', [
                    'icon'  => 'error',
                    'title' => 'Username atau password',
                    'text'  => 'Salah!'
                ]);
            }
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect()->to(url(''));
    }
}
