<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Facade\Ignition\Support\LaravelVersion;
use Illuminate\Support\Facades\Validator;
use Symfony\Contracts\Service\Attribute\Required;
use Exception;
use Auth;

class AppController extends Controller
{
    public function index(Request $request)
    {
        $result = array('status' => true, 'message' => "Hello from App");
        $responseCode = 200;

        return response()->json($result, $responseCode);
    }
}
