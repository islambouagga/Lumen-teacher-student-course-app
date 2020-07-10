<?php

namespace App\Http\Controllers;

use App\Course;

class CourseController extends Controller
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
            $courses =  Course::all();
            return $this->createSuccessResponse($courses ,200);

        }


    /**
     * Display the specified resource.
     *
     * @param $course_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($course_id)
    {

        $course=Course::find($course_id);
        if ($course){
            return  $this->createSuccessResponse($course,200);
        }else{
            return $this->createErrorMessage("the course does not exists",404);

        }
    }



}
