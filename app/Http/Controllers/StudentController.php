<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $students = Student::all();
        return $this->createSuccessResponse($students, 200);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        $sudent = Student::create($request->all());
        return $this->createSuccessResponse("the student  with id {$sudent->id} has been created ", 200);

    }

    public function show($student_id)
    {
        $course = Student::find($student_id);
        if ($course) {
            return $this->createSuccessResponse($course, 200);
        } else {
            return $this->createErrorMessage("the course does not exists", 404);

        }
    }

    public function update(Request $request, $student_id)
    {
        $student = Student::find($student_id);
        if ($student) {
            $this->validateRequest($request);
            $student->update($request->all());
            return $this->createSuccessResponse("the student  with id {$student->id} has been updated ",200);
        }
        return $this->createErrorMessage("the student does not exist ", 404);
    }

    public function destroy($student_id)
    {
       $student = Student::find($student_id);
       if ($student){
           $student->courses()->detach();
           $student->delete();
           return $this->createSuccessResponse("the student  with id {$student->id} has been deleted ",200);
       }
        return $this->createErrorMessage("the student does not exist ", 404);
    }

    public function validateRequest($request)
    {
        $rules = [
            'name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'career' => 'required|in:Database,AI,Algorithme'
        ];
        $this->validate($request, $rules);
    }
}
