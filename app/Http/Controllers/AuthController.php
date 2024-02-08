<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    private $not_found_img_path = "images/img-not-found.jpg";

    public function showSignupForm()
    {
        return view('auth.signup');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'pic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'phoneNumber' => 'required|string|numeric|min:9',
            'password' => 'required|string|min:8|max:255',
            'role' => 'required|string',
        ]);


        $imagePath = $request->hasFile('pic') ? $request->file('pic')->store('public/images') : $this->not_found_img_path;



        $user = User::create([
            'name' => $request->input('name'),
            'pic' => $imagePath,
            'phoneNumber' => $request->input('phoneNumber'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role'),
        ]);

        return redirect()->route('login');
    }






    // Login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'phoneNumber' => 'required|string|numeric|min:9',
            'password' => 'required|string|min:8|max:255',
        ]);

        $credentials = [
            'phoneNumber' => $request->input('phoneNumber'),
            'password' => $request->input('password'),
        ];

        try {
            if (Auth::attempt($credentials)) {

                // After login done save user data
                $user = Auth::user();

                session(['user_id' => $user->id, 'user_role' => $user->role]);

                return redirect()->intended('/home');

            }
        } catch (\Exception $e) {
            // Handle any exceptions during the authentication attempt
        }

        throw ValidationException::withMessages(['phoneNumber' => 'Invalid credentials']);
    }


    public function logout()
    {
        Auth::logout();

         return redirect('/login');
    }


}
