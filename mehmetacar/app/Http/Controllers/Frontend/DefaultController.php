<?php

namespace App\Http\Controllers\Frontend;

use App\About;
use App\Http\Controllers\Controller;
use App\Study;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function index()
    {
        $about=About::all()->first();
        $skills = Study::all()->sortBy('must')->where('status',1);
        $studies = Study::all()->sortBy('must')->where('projects_status',1);
        return view("frontend.default.index",compact('about','studies','skills'));
    }

}
