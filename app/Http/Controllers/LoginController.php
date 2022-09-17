<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidationValidator;

class LoginController extends Controller
{

    public function index(Request $request)
    {
        $username = "himti";
        $password = hash("sha256", "hayomauhackya");

        $auth = $request->header("Authorization", false);

        if (!$auth) return response()->json('unauthorized', 400);

        $base64 = explode(" ", $auth)[1] ?? "";
        $userpass = explode(":", base64_decode($base64));
        if ($userpass[0] != $username || $userpass[1] != $password) return response()->json('unauthorized', 400);

        return response()->json(User::all());
    }

    public function update(Request $request, $id)
    {
        $username = "himti";
        $password = hash("sha256", "hayomauhackya");

        $auth = $request->header("Authorization", false);

        if (!$auth) return response()->json('unauthorized', 400);

        $base64 = explode(" ", $auth)[1] ?? "";
        $userpass = explode(":", base64_decode($base64));
        if ($userpass[0] != $username || $userpass[1] != $password) return response()->json('unauthorized', 400);

        try {
            $user = User::findOrFail($id)->update($request->toArray());
        } catch (Exception $e) {
            return response()->json('not found', 404);
        }

        return response()->json($user);
    }
}
