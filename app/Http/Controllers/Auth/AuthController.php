<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Giao diện đăng nhập
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('auth.login')->with('title', 'Đăng nhập');
    }

    /**
     * Xác thực đăng nhập.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        if ($this->authService->authenticate($request)) {
            return redirect()->route('homepage');
        } else return back()->withErrors([
            'email' => 'Sai mật khẩu hoặc tài khoản không tồn tại',
        ]);
    }

    /**
     * Đăng xuất
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('homepage');
    }

    /**
     * Hiển thị form đăng ký
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegisterForm()
    {
        return view('auth.register', [
            'title' => 'Đăng ký'
        ]);
    }

    /**
     * Đăng ký
     *
     * @param  \App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function register(UserRequest $request)
    {
        $this->authService->register($request);
        return back()->with('message', 'Đăng ký thành công');
    }

    /**
     * Form đổi mật khẩu
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        return view('admin.pages.change_password', [
            'title' => 'Đổi mật khẩu'
        ]);
    }

    /**
     * Cập nhật mật khẩu
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $message = $this->authService->updatePassword($request);
        return redirect()->back()->with('message', $message);
    }
}
