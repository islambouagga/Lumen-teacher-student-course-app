<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
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
            $teachers = Teacher::all();
            return $this->createSuccessResponse($teachers,200);
        }

    public function store(Request $request)
        {

         $this->validateRequest($request);

            $teacher=  Teacher::create($request->all());
            return $this->createSuccessResponse("the teacher  with id {$teacher->id} has been created ",200);
        }

    /**
     * Display the specified resource.
     *
     * @param Teacher $teacher
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($teacher_id)
    {
        $teacher=Teacher::find($teacher_id);

        if ($teacher)
        {
            return $this->createSuccessResponse($teacher,200);
        }
        return $this->createErrorMessage("the teacher does not exist ", 404);
    }

    public function update(Request $request,$teacher_id)
    {
       $teacher =  Teacher::find($teacher_id);
       if ($teacher){
           $this->validateRequest($request);
           $teacher->update($request->all());
           return $this->createSuccessResponse("the teacher  with id {$teacher->id} has been updated ",200);
       }
        return $this->createErrorMessage("the teacher does not exist ", 404);
    }

    public function destroy($teacher_id)
    {
        $teacher = Teacher::find($teacher_id);
        if ($teacher){
            $courses =  $teacher->courses;
            if (sizeof($courses)> 0){
                return $this->createErrorMessage("you can't delete a teacher with active courses , please remove those courses first  ", 404);
            }
            $teacher->delete();
            return $this->createSuccessResponse("the teacher  with id {$teacher->id} has been deleted  ",200);
        }

        return $this->createErrorMessage("the teacher does not exist ", 404);
    }

    public function validateRequest($request)
    {
        $rules = [
            'name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'profession' => 'required|in:Database,AI,Algorithme'
        ];
        $this->validate($request, $rules);
    }

}
