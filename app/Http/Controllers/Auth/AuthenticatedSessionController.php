<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */

    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();
            $request->session()->regenerate();

            // Simpan nama user dalam session
            session()->flash('welcome_back', 'Hai, ' . Auth::user()->name.'.');

            if ($request->has('redirect')) {
                return redirect($request->input('redirect'))->with('success', 'Login berhasil!');
            }

            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.admin.page')->with('success', 'Login berhasil sebagai Admin!');
            }

            if (Auth::user()->hasRole('teacher')) {
                return redirect()->route('teacher.teacher.page')->with('success', 'Login berhasil sebagai Guru!');
            }

            return redirect('/')->with('success', 'Login berhasil!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors();

            if ($errors->has('email')) {
                return back()->with('email_error', $errors->first('email'));
            }

            if ($errors->has('password')) {
                return back()->with('password_error', $errors->first('password'));
            }

            return back();
        }
    }



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
