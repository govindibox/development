<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UserProfile;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {       
        //Password::min(6)->letters()->mixedCase()->numbers()
        return Validator::make($data, [
            'username' => 'required|alpha_num|max:15',
            'email' => 'bail|required|email',
            'password' => ['required', 'confirmed', Password::min(6)],
            'mobile' => 'bail|required|digits:10',
            'first_name' => 'bail|required|alpha',
            'last_name' => 'bail|required|alpha',
            'dob' => 'bail|required|date_format:d/m/Y',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {        
        $new_user=User::create([
            'name' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),            
        ]); 

        $dobDate = Carbon::createFromFormat('d/m/Y', $data['dob'])->format('Y-m-d');
        
        $new_profile=UserProfile::create([
            'mobile' => $data['mobile'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'dob' => $dobDate,
            'user_id'=>$new_user->id,
            'role_id'=>1
        ]);        
        return $new_user;
    }
}
