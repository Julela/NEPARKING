<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;
use App\Models\Kendaraan;


class AdminController extends Controller
{
    public function myProfile()
    {
        return view('admin.admin-myprofile'); 
    }

    public function dataKendaraan()
    {
        $vehicles = Kendaraan::all(); // Ambil semua kendaraan dari database
        return view('admin.dataKendaraan', compact('vehicles'));
    }
}
