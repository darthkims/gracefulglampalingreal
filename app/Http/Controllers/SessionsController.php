<?php

namespace App\Http\Controllers;

Use Str;
Use Hash;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;

class SessionsController extends Controller
{
    public function create(Request $request)
    {
        $prevParam = $request->query('prev');

        return view('sessions.create', compact('prevParam'));
    }

    public function store(Request $request)
    {
        $prevParam = $request->prev;
        $attributes = $request->validate([
            'identifier' => 'required', // 'identifier' can be either email or username
            'password' => 'required'
        ]);
    
        // to determine if the input is an email or username
        $field = filter_var($attributes['identifier'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    
        // build credentials array based on the identified field
        $credentials = [
            $field => $attributes['identifier'],
            'password' => $attributes['password']
        ];
    
        if (!auth()->attempt($credentials)) {
            throw ValidationException::withMessages([
                'identifier' => 'Your provided credentials could not be verified.'
            ]);
        }

        // if the authenticated user has the 'admin' role
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.home'); // redirect admin to admin panel
        }

        session()->regenerate();

        if ($prevParam) {
            return redirect($prevParam);
        } else {
            return redirect('/dashboard');
        }
    }

    public function show(){
        request()->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            request()->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
        
    }

    public function update(){
        
        request()->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]); 
          
        $status = Password::reset(
            request()->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => ($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
    
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/sign-in');
    }

}
