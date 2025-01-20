<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserValidate;
use Validator;


class UserApiController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json(['users' => $users, 'message' => 'User List']);
    }

    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|max:20|min:3',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:3|max:10',
    //         'gender' => 'required|max:200|min:3',
    //         'phone' => 'required|integer|digits:10',
    //         'address' => 'required|max:200|min:3',
    //         'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'


    //     ]);

    //     if ($validator->fails()) {
    //         $response['response'] = $validator->messages();
    //         return response()->json($response);
    //     }
    //     $password = Hash::make($request->password);
    //     $imagePaths = [];

    //     if ($request->hasFile('images')) {
    //         foreach ($request->file('images') as $image) {
    //             $imgName = time() . rand(100000, 999999) . '.' . $image->getClientOriginalExtension();
    //             $image->move(public_path('images'), $imgName);
    //             $imagePaths[] = 'images/' . $imgName;
    //         }
    //     }

    //     $user = new User;
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->password = $password;
    //     $user->phone = $request->phone;
    //     $user->image = !empty($imagePaths) ? json_encode($imagePaths) : null;
    //     $user->gender = $request->gender;
    //     $user->address = $request->address;
    //     $user->save();

    //     return response()->json(['user' => $user, 'message' => 'User Created Successfully']);
    // }

        public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3|max:10',
            'gender' => 'required|max:200|min:3',
            'hobby' => 'required|max:200|min:3',
            'phone' => 'required|integer|digits:10',
            'address' => 'required|max:200|min:3',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()]);
        }

        $password = Hash::make($request->password);
        $imagePath = [];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imgName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imgName);
            $imagePath = 'images/' . $imgName;
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $password;
        $user->phone = $request->phone;
        $user->image = $imagePath;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->save();

        return response()->json(['user' => $user, 'message' => 'User Created Successfully']);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        // dd($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20|min:3',
            'phone' => 'required|integer|digits:10',
            'gender' => 'required|max:200|min:3',
            'address' => 'required|max:200|min:3',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()]);
        }

        $imagePaths = [];

        if ($request->hasFile('images')) {
            // Remove existing images
            $existingImages = json_decode($user->image, true);
            if ($existingImages && is_array($existingImages)) {
                foreach ($existingImages as $existingImage) {
                    if (file_exists(public_path($existingImage))) {
                        unlink(public_path($existingImage));
                    }
                }
            }

            // Upload new images
            foreach ($request->file('images') as $image) {
                $imgName = time() . rand(100000, 999999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imgName);
                $imagePaths[] = 'images/' . $imgName;
            }
        }

        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->image = !empty($imagePaths) ? json_encode($imagePaths) : $user->image;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->save();

        return response()->json(['user' => $user, 'message' => 'User Updated Successfully']);
    }

    public function delete($id)
    {
        // Ensure the user is authenticated


        // Find the user by ID
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return redirect('user/list')->with('error', 'User not found');
        }

        // Decode the image JSON if it exists
        $images = $user->image ? json_decode($user->image, true) : [];

        // Ensure images is an array before deleting files
        if (is_array($images)) {
            foreach ($images as $image) {
                $imagePath = public_path($image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }

        // Delete the user record from the database
        $user->delete();

        return response()->json(['message' => 'User Deleted Successfully']);
    }

}
