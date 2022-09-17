<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResponseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'assignment_id' => 'required|exists:assignments,id',
            'user_id' => 'required|exists:users,id',
            'filename' => 'required',
            'path_file' => 'required',
            'extension' => 'required',
        ]);


        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $data = Response::create($request->toArray());

        return response()->json($data);

    }
}
