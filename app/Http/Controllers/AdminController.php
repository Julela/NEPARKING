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



    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'gender' => 'required|boolean',
            'address' => 'nullable|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'address' => $request->address,
        ];

        if ($request->hasFile('img')) {
            if ($user->img && file_exists(public_path('img/' . $user->img))) {
                unlink(public_path('img/' . $user->img));
            }

            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img'), $imageName);

            $data['img'] = $imageName; // Pastikan ini disimpan ke database
        }

        $user->update($data);

        return redirect()->back()->with('success', 'Profile berhasil diperbarui!');
    }



    public function dataKendaraan()
    {
        $vehicles = Kendaraan::all(); // Ambil semua kendaraan dari database
        return view('admin.dataKendaraan', compact('vehicles'));
    }
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalParked = ParkingA::whereNull('waktu_masuk')->count();
        $totalParkeds = ParkingB::whereNull('waktu_masuk')->count();
        return view('admin.dashboard', compact('totalUsers', 'totalParked', 'totalParkeds'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.dataUser', compact('users'));
    }
    public function create()
    {
        return view('admin.createUser');
    }

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // Simpan data pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Enkripsi password
        ]);

        return redirect()->route('admin.admin.dataUser')->with('success', 'Pengguna berhasil ditambahkan');
    }
    // Menampilkan form edit pengguna
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.editUser', compact('user'));
    }

    // Memperbarui data pengguna
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect()->route('admin.admin.dataUser')->with('success', 'Data pengguna berhasil diperbarui.');
    }
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.admin.dataUser')->with('success', 'Pengguna berhasil dihapus.');
    }


    public function parking()
    {
        $parkingA = ParkingA::latest()->get();
        $parkingB = ParkingB::latest()->get();
        return view('admin.parking', compact('parkingA', 'parkingB'));
    }
    public function destroyParking($id, $type)
    {
        if ($type === 'A') {
            ParkingA::where('id', $id)->delete();
        } else {
            ParkingB::where('id', $id)->delete();
        }
        return redirect()->route('admin.admin.parking')->with('success', 'Kendaraan berhasil dihapus.');
    }

    public function reports()
    {
        $historyA = ParkingA::whereNotNull('waktu_keluar')->latest()->get();
        $historyB = ParkingB::whereNotNull('waktu_keluar')->latest()->get();

        return view('admin.reports', compact('historyA', 'historyB'));
    }
}
