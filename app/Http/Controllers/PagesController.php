<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Student;


class PagesController extends Controller
{
    //
    public function userProfile()
    {
        $user = User::find(1); // Assuming you want to fetch the user with ID 1
        echo $user->name . " - " . $user->profile->bio; // Accessing the bio attribute from the related profile
    }

    public function userPosts()
    { 
        $user = User::find(1); // Assuming you want to fetch the user with ID 1
        foreach ($user->posts as $post) {
            echo "$user->name: $post->title - $post->content <br>"; // Accessing the title attribute from each related post
        }
    }
    public function studentCourses()
    {
        $student = Student::find(2); // Assuming you want to fetch the student with ID 1
        foreach ($student->courses as $course) {
            echo "$student->first_name is enrolled in: $course->course_name <br>"; // Accessing the course_name attribute from each related course
        }
    }
    public function maintenance()
    {
        return view('maintenance');
    }
}
