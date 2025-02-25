<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;

class AdminController extends Controller
{
    public function myProfile()
    {
        return view('admin.admin-myprofile'); 
    }
}
