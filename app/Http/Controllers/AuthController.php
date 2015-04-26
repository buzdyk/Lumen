<?php namespace App\Http\Controllers;

use Auth, Validator;
use App\User;

class AuthController extends Controller
{
    public function postRegister()
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
        ];

        $input = $_POST;

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return $this->respondWithFailedValidation($validator);
        }

        $user = new User();
        $user->email    = $input['email'];
        $user->password = bcrypt($input['password']);
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->save();

        return $this->respondWithSuccess('Register successful');
    }

    public function postLogin()
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $input = $_POST;

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return $this->respondWithFailedValidation($validator);
        }

        if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) {
            return $this->respondWithSuccess('Login successful');
        } else {
            return $this->respondWithErrors(['Invalid Email/Password pair']);
        }
    }
}
