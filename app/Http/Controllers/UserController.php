<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function getLogin(Request $request)
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with([
                'status'=> 'error',
                'message'=> 'Thông tin đăng nhập không chính xác'
            ]);
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect()->route('login');
    }

    public function profile() 
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function updateProfile(Request $request) 
    {
        if (!Auth::check()) {
            return false;
        }

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        if($request->change_pass)
        {
            $validated = $request->validate([
                'password' => 'required|min:4',
                'password_confirm' => 'required|same:password'
            ]);
        }

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        if($request->change_pass)
        {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();        

        return redirect()->back()->with([
            'status'=> 'success',
            'message'=> 'Cập nhật Profile thành công'
        ]);
    }
}
