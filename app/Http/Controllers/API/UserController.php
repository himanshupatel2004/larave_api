<?php

namespace App\Http\Controllers\API;
// namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Facade\Ignition\Support\LaravelVersion;
use Illuminate\Support\Facades\Validator;
use Symfony\Contracts\Service\Attribute\Required;

use Exception;
use Auth;

class UserController extends Controller
{
    // function to create user
    public function createUser(Request $request)
    {

        $validator = validator::make($request->all(), [
            'name' => "required|string",
            'phone' => "required|string|digits:10",
            'email' => 'required|email|unique:users,email',
            'password' => "required|min:6"
        ]);

        if ($validator->fails()) {
            $result = array(
                'status' => false,
                'message' => "Validator error occured",
                'error_message' => $validator->errors()
            );
            return response()->json($result, 400);  // Bad Request
        }
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($user->id) {
            $result = array('status' => true, 'message' => "User Create", 'data' => $user);
            $responseCode = 200; // Success
        } else {
            $result = array('status' => false, 'message' => "Something went wrong");
            $responseCode = 400; // Bad Request
        }

        return response()->json($result, $responseCode);
    }
    // function to return all users
    public function getUsers()
    {
        try {
            $users = User::all();
            $result = array('status' => true, 'message' => count($users) . " User(s) fetched", 'data' => $users);
            $responseCode = 200; // Success
            // dd($request);
            return response()->json($result, $responseCode);
        } catch (Exception $e) {
            $result = array('status' => true, 'message' => "API failed dueto an error", "error" => $e->getMessage());
            return response()->json($result, 500);
        }
    }

    // public function getUsersDetail($id)
    // {
    //     $user = User::find($id);
    // if (!$user) {
    //     return response()->json(['status' => false, 'message' => "User not found"], 400);
    // }
    //     $result = array('status' => true, 'message' => "User found", 'data' => $user);
    //     $responseCode = 200; // Success
    //     // dd($request);
    //     return response()->json($result, $responseCode);
    // }


    // getUsersDetail function
    public function getUsersDetail($id)
    {
        //dd($id); // Debug the request data

        $user = User::where('id', $id)
            //->where('status', 'active')  // Add your condition
            ->first();

        // dd($user); // Debug the user data

        if ($user) {
            $result = array('status' => true, 'message' => "User found", 'data' => $user);
            $responseCode = 200; // Success
        } else {
            $result = array(['status' => false, 'message' => "User not found"], 'data' => []);
            $responseCode = 404; // Not Found
        }

        return response()->json($result, $responseCode);
    }

    // update function
    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['status' => false, 'message' => "User not found"], 400);
        }

        $validator = validator::make($request->all(), [
            'name' => "required|string",
            'phone' => "required|string|digits:10",
            'email' => "required|email|unique:users,email," . $id,
        ]);

        if ($validator->fails()) {
            $result = array(
                'status' => false,
                'message' => "Validator error occured",
                'error_message' => $validator->errors()
            );
            return response()->json($result, 400);  // Bad Request
        }

        // Update data
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;

        $user->save();

        $result = array('status' => true, 'message' => "User has been Updated successfully", 'data' => $user);

        return response()->json($result, 200);
    }

    // delete function
    public function deleteUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['status' => false, 'message' => "User not found"], 404);  // Not Found
        }
        $user->delete();
        return response()->json(['status' => true, 'message' => "User has been deleted successfully"], 200);  // Success
    }

    // login function
    // public function login(Request $request) {
    //     $user = User::where('$id');
    //     $validator = validator::make($request->all(), [
    //         'email' => 'required|email|unique:users,email',
    //         'password' => "required|min:6"
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['status' => false,'message' => "Validator error occured",
    //         'errors' => $validator->errors()], 400);  // Bad Request
    //     }

    //     $credentials = $request->only("email","password");

    //     if(Auth::attempt($credentials)){
    //         $user = Auth::user();
    //         return response()->json(['status' => true, "message" => "Login successful","data" => $user], 200);
    //     }

    //     return response()->json(['status' => false, "message" => "Invalid login credntials"], 401);

    // }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // If validator fails, return error response
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error occurred',
                'errors' => $validator->errors()
            ], 400);  // Bad Request
        }

        $credentials = $request->only('email', 'password');
        //dd($credentials);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Creating a Token
            $token = $user->createToken('myApp')->accessToken;

            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                "token" => $token
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Invalid login credentials'
        ], 401);
    }

    // unauthenticate function
    public function unauthenticate()
    {

        return response()->json(['status' => false, 'message' => "Only authorised user can access", "error" => "unauthenticated"], 401);
    }

    // unauthenticate function
    public function logout()
    {
       $user = Auth::user();
       $user->tokens->each(function ($token, $key) {
          $token->detele();
       });

    //    $user = Auth::guard('api')->user();



       return response()->json(['status' => false, 'message' => "Logged out successfully"], 200);

    }
}