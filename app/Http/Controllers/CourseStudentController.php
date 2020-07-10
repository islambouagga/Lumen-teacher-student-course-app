<?php

namespace App\Http\Controllers;

use App\Course;
use App\Student;

class CourseStudentController extends Controller
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

    public function index($course_id)
    {
        $course = Course::find($course_id);
        if ($course) {
            $studnets = $course->students;
            return $this->createSuccessResponse($studnets, 200);
        }
        return $this->createErrorMessage("the course does not exists", 404);
    }

    public function store($course_id, $student_id)
    {
        $course = Course::find($course_id);
        if ($course) {
            $student = Student::find($student_id);
            if ($student) {
                if ($course->students()->find($student->id)) {
                    return $this->createErrorMessage("the student  with id {$student->id} id already exists in the course {$course->id} ", 404);
                }
                $course->students()->attach($student->id);
                return $this->createSuccessResponse("the student  with id {$student->id} has been added to the course {$course->id} ", 200);
            }
            return $this->createErrorMessage("the student does not exists", 404);
        }
        return $this->createErrorMessage("the course does not exists", 404);
    }


    public function destroy($course_id,$student_id)
    {
        $course = Course::find($course_id);
        if ($course) {
            $student = Student::find($student_id);
            if ($student) {
                if (!$course->students()->find($student->id)) {
                    return $this->createErrorMessage("the student  with id {$student->id} id does not  exists in the course {$course->id} ", 404);
                }
                $course->students()->detach($student->id);
                return $this->createSuccessResponse("the student  with id {$student->id} has been removed from the course {$course->id} ", 200);
            }
            return $this->createErrorMessage("the student does not exists", 404);
        }
        return $this->createErrorMessage("the course does not exists", 404);
    }

}
