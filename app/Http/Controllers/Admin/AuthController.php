<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\RegisterRequest;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('admin-login');
    }

    public function registerPage()
    {
        return view('admin-register');
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $login = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];
        if (Auth::attempt($login)) {
            if(Auth::user()->roles['name'] == 'ADMIN'){
                return redirect('/admin/dashboard');
            }else if(Auth::user()->roles['name'] == 'USER'){
                return redirect('/');
            }
        } else {
            return redirect('/admin-login')->with('status', 'Email hoặc Password không chính xác');
        }
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $role = Roles::where('name', 'USER')->first();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'gender' => null,
            'date_of_birth' => null,
            'phone' => null,
            'address' => null,
            'image' => null,
            'details' => null,
            'identification' => null,
            'deleted' => null,
            'role_id' => $role->_id
        ]);
        return redirect('admin-login')->with('message', 'Đăng ký tài khoản thành công');
    }
}
