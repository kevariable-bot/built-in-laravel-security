<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application password form.
     *
     * @return \Illuminate\View\View
     */
    public function showPasswordForm()
    {
        return view('auth.passwords.password');
    }

    /**
     * Handle a password request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function changePassword()
    {
        $this->validator(request()->all())->validate();

        if ($this->checkingOldPassword()) {

            $this->update(request()->password);

            return back()->withSuccess('Your password has been changed.');
        }

        return back()->withErrors([
            'old_password' => 'Make sure you fill your current password'
        ]);
    }

    /**
     * Get a validator for an incoming password request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'old_password' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
    }

    /**
     * Update a new password instance after a valid registration & hash check
     *
     * @return \App\User
     */
    protected function update($newPassword)
    {
        return auth()->user()->update([
            'password' => bcrypt($newPassword)
        ]);
    }

    /**
     * Checking current password and old password
     * 
     * @return bool
     */
    protected function checkingOldPassword(): bool
    {
        $currentPassword = auth()->user()->password;
        $oldPassword = request()->old_password;

        if (!Hash::check($oldPassword, $currentPassword)) {
            return false;
        }

        return true;
    }
}
