<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    // Xác thực người dùng
    public function authenticate($request): bool
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            return true;
        }
        return false;
    }

    public function register($request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        User::create($data);
    }

    // Cập nhật mật khẩu
    public function updatePassword($request)
    {
        $request->validate([
            'old_password' => 'required|string|max:255',
            'new_password' => 'required|string|min:3|max:255',
            'new_confirm_password' => 'required|string|min:3|max:255|same:new_password',
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return $message = 'Mật khẩu cũ không chính xác';
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return $message = 'Đổi mật khẩu thành công';
    }
}
