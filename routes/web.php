<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});



$router->get('/teachers','TeacherController@index');
$router->post('/teachers','TeacherController@store');
$router->get('/teachers/{teacher_id}','TeacherController@show');
$router->put('/teachers/{teacher_id}','TeacherController@update');
$router->patch('/teachers/{teacher_id}','TeacherController@update');
$router->delete('/teachers/{teacher_id}','TeacherController@destroy');


$router->get('/students','StudentController@index');
$router->post('/students','StudentController@store');
$router->get('/students/{student_id}','StudentController@show');
$router->put('/students/{student_id}','StudentController@update');
$router->patch('/students/{student_id}','StudentController@update');
$router->delete('/students/{student_id}','StudentController@destroy');


$router->get('/courses','CourseController@index');
$router->get('/courses/{course_id}','CourseController@show');



$router->get('/teachers/{teacher_id}/courses','TeacherCourseController@index');
$router->post('/teachers/{teacher_id}/courses','TeacherCourseController@store');
$router->patch('/teachers/{teacher_id}/courses/{course_id}','TeacherCourseController@update');
$router->put('/teachers/{teacher_id}/courses/{course_id}','TeacherCourseController@update');
$router->delete('/teachers/{teacher_id}/courses/{course_id}','TeacherCourseController@destroy');



$router->get('/courses/{course_id}/students','CourseStudentController@index');
$router->post('/courses/{course_id}/students/{student_id}','CourseStudentController@store');
$router->delete('/courses/{course_id}/students/{student_id}','CourseStudentController@destroy');
