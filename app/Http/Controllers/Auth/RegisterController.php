<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserValidate;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Traits\ApiResponse;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        return view('register');
    }


    // public function store(UserValidate $request)
    // {
    //     // Validation handled by UserValidate

    //     // If validation fails, errors will be automatically sent back to the form
    //     $password = Hash::make($request->password);

    //     // Create a new user
    //     $image = $request->file('image');
    //     if ($image) {
    //         $img_name = time() . rand(100000, 999999) . $request->image->getclientOriginalName();
    //         // $image->move('profile-image/',$img_name);
    //         // $img_name = "profile-image/".$img_name;

    //         $image->move('images/', $img_name);
    //         $img_name = "images/" . $img_name;
    //     }
    //     $user = new User;
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->address = $request->address;
    //     $user->phone = $request->phone;
    //     $user->hobby = ($request->hobby) ? implode(',', $request->hobby) : null;
    //     $user->image = isset($img_name) ? $img_name : null;

    //     $user->password = $password;
    //     $user->gender = $request->gender; // Store gender from the request
    //     $user->save();

    //     // Redirect with success message
    //     return redirect('/')->with('success', 'User Registered Successfully');
    // }


    public function store(UserValidate $request)
    {
        $password = Hash::make($request->password);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imgName = time() . rand(100000, 999999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imgName);
                $imagePaths[] = 'images/' . $imgName;
            }
        }
        // dd($imagePaths);


        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->hobby = ($request->hobby) ? implode(',', $request->hobby) : null;
        $user->image = !empty($imagePaths) ? json_encode($imagePaths) : null;
        $user->password = $password;
        $user->gender = $request->gender;
        $user->save();

        return redirect('/')->with('success', 'User Registered Successfully');
    }
}