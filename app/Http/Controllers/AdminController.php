<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;
use App\Models\Kendaraan;
use App\Models\ParkingA;
use App\Models\ParkingB;
use App\Models\User;


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
    public function dashboard() {
        $totalUsers = User::count();
        $totalParked = ParkingA::whereNull('exit_time')->count();
        $totalParkeds = ParkingB::whereNull('exit_time')->count();
        return view('admin.dashboard', compact('totalUsers', 'totalParked'));
    }

    public function users() {
        $users = User::all();
        return view('admin.dataUser', compact('users'));
    }

    public function parking() {
        $parkingA = ParkingA::latest()->get();
        $parkingB = ParkingB::latest()->get();
        return view('admin.parking', compact('parkingA', 'parkingB'));
    }
    
    public function deleteParking($id, $type) {
        if ($type === 'A') {
            $parking = ParkingA::find($id);
        } else {
            $parking = ParkingB::find($id);
        }
    
        if (!$parking) {
            return redirect()->route('admin.parking')->with('error', 'Data parkir tidak ditemukan.');
        }
    
        $parking->delete();
    
        return redirect()->route('admin.parking')->with('success', 'Kendaraan berhasil dihapus.');
    }
    
    

    public function reports() {
        return view('admin.reports');
    }

    public function settings() {
        return view('admin.settings');
    }
}
