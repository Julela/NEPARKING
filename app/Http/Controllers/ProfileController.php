<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function myProfile (Request $request): View
    {
        return view('profile.user-myprofile', [
            'user' => $request->user(),
        ]);
    }
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }


    public function update(Request $request, $id)
    {

        // dd($request->all());
    
        $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email|unique:users,email,' . $id,
            'gender' => 'required|boolean',
            'class_id' => 'required|exists:classes,id', 
            'address' => 'required|string|max:255',

        ]);
    
        $user = User::findOrFail($id);
    
        // Upload Image jika ada
        if ($request->hasFile('img')) {
            if ($user->img && file_exists(public_path('img/' . $user->img))) {
                unlink(public_path('img/' . $user->img));
            }
    
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img'), $imageName);
        } else {
            $imageName = $user->img;
        }
    
        // Update Data
        $user->update([
            'name' => $request->name,
            'img' => $imageName,
            'email' => $request->email,
            'gender' => (int) $request->gender,
            'class_id' => $request->class, 
            'address' => $request->address, 
        ]);
    
        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
    

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'email' => 'required|email|unique:users,email',
        'gender' => 'required|boolean',
        'class_id' => 'required|exists:classes,id',
        'address' => 'required|string|max:255',
    ]);

    $imageName = null;
    if ($request->hasFile('img')) {
        $image = $request->file('img');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('img'), $imageName);
    }

    User::create([
        'name' => $request->name,
        'img' => $imageName,
        'email' => $request->email,
        'gender' => (int) $request->gender,
        'class_id' => $request->class_id,
        'address' => $request->address,
        'password' => bcrypt('password123'), // Set password default
    ]);

    return redirect()->route('profile.edit')->with('success', 'User berhasil dibuat!');
}




    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
