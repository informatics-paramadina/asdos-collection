<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);


        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $course = Course::create($request->toArray());

        return response()->json($course);

    }

    public function studentIndex()
    {

        $email = auth('api')->user()->email;
        $course = Student::with('courses')->where('email', $email)->get();

        return response()->json($course);
    }
}
