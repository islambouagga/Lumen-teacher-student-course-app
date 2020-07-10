<?php

namespace App\Http\Controllers;

use App\Course;
use App\Teacher;
use Illuminate\Http\Request;

class TeacherCourseController extends Controller
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

    public function index($teacher_id)
        {
            $teacher =  Teacher::find($teacher_id);
            if ($teacher){
                $courses =  $teacher->courses;
                return  $this->createSuccessResponse($courses,200);
            }
            return $this->createErrorMessage("the teacher does not exist ", 404);
        }

    public function store(Request $request ,$teacher_id)
        {
            $teacher =Teacher::find($teacher_id);
            if ($teacher){
                $this->validateRequest($request);
                $course =   Course::create(
                  [
                      'title'=>$request->get('title') ,
                      'description'=>$request->get('description'),
                      'value'=>$request->get('value'),
                      'teacher_id'=> $teacher->id
                  ]
                );
                return  $this->createSuccessResponse("the course with id {$course->id} has been created and associate with the teacher {$teacher->id}",201);
            }

            return $this->createErrorMessage("the teacher does not exist ", 404);


        }


    public function update(Request $request ,$teacher_id,$course_id)
    {
        $teacher = Teacher::find($teacher_id);
        if ($teacher){
            $course= Course::find($course_id);
            if ($course){
                $this->validateRequest($request);
                $course->title= $request->get('title');
                $course->description= $request->get('description');
                $course->value= $request->get('value');
                $course->teacher_id= $teacher_id;
                $course->save();
                return $this->createSuccessResponse("the course  with id {$course->id} has been updated ",200);
            }
            return $this->createErrorMessage("the course does not exist ", 404);
        }
        return $this->createErrorMessage("the teacher does not exist ", 404);
    }

    public function destroy($teacher_id,$course_id)
    {
        $teacher = Teacher::find($teacher_id);
        if ($teacher){
            $course= Course::find($course_id);
            if ($course){
                if ($teacher->courses()->find($course->id)){
                    $course->students()->detach();
                    $course->delete();
                    return $this->createSuccessResponse("the course  with id {$course->id} has been deleted ",200);
                }
                return $this->createErrorMessage("the course with id {$course->id} is not associated with the teacher  {$teacher->id} ", 404);
            }
            return $this->createErrorMessage("the course does not exist ", 404);
        }
        return $this->createErrorMessage("the teacher does not exist ", 404);
    }
    public function validateRequest($request)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'value' => 'required|numeric',
        ];
        $this->validate($request, $rules);
    }
}
