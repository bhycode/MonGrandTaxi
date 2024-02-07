<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        return redirect()->route('signup');
    }
}
