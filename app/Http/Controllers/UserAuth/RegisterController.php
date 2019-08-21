<?php

namespace App\Http\Controllers\UserAuth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use App\Services\ServiceUser;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('user.guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'cpf' => 'required',
            'rg' => 'required',
            'cellphone' => 'required',
            'zip_code' => 'required',
            'street' => 'required',
            'number' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required',
            'bank_code' => 'required',
            'agency' => 'required',
            'account' => 'required',
            'account_type' => 'required',
            'cpf_holder' => 'required',
            'name_holder' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $service = new ServiceUser;
        $data['status'] = 0;
        $dataUser = $service->generateDatauser($data);
        $dataUser['user_id'] = session('user_id');
        $dataAdress = $service->generateDataAddress($data);
        $dataBank = $service->generateDataBank($data);

        $user = User::create($dataUser);
        $user->address()->create($dataAdress);
        $user->databank()->create($dataBank);
        return $user;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm($user)
    {
        $user = User::find($user);
        return view('user.auth.register')->with('user', $user);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('user');
    }
}
