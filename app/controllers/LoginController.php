<?php
/**
 * Created by PhpStorm.
 * User: Thibault
 * Date: 02/02/2015
 * Time: 14:04
 */

class LoginController extends BaseController {

    public function showLogin()
    {
        if (Auth::check())
        {
            return View::make('home/home');
        }
        else
        {
            return View::make('login/login');
        }
    }

    public function doLogin()
    {
//        process the form

        $rules = array(
            'username'    => 'required',
            'password' => 'required|alphaNum|min:3'
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('/')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {

            // create our user data for the authentication
            $userdata = array(
                'username'     => Input::get('username'),
                'password'  => Input::get('password')
            );

            // attempt to do the login
            if (Auth::attempt($userdata)) {

                return Redirect::intended('/home');

            } else {

                // validation not successful, send back to form
                return Redirect::to('/');

            }

        }
    }

    public function doLogout()
    {
        Auth::logout();
        return \Illuminate\Support\Facades\Redirect::to('/');
    }



} 