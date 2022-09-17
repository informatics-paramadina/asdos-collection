<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|exists:courses,id',
            'title' => 'required',
            'open_at' => 'required',
            'closed_at' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $assignment = Assignment::create($request->toArray());

        return response()->json($assignment);

    }


    public function showUser($id)
    {
        // check if user has permission to see assignment

        $data = Assignment::find($id);
        if(!$data) return response()->json("not found", 404);

        return response()->json($data);
    }
}
