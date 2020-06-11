<?php

namespace App\Http\Controllers\UserAuth;

use App\User;
use Validator;
use App\Rules\CPFValidate;
use App\Rules\PhoneValidate;
use App\Services\ServiceUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;

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
            'cpf' => ['required', new CPFValidate("CPF")],
            'rg' => 'required',
            'cellphone' => ['required', 'string', 'max:255', new PhoneValidate()],
            'zip_code' => 'required',
            'street' => 'required',
            'number' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required',
            'bank_code' => 'required|numeric',
            'agency' => 'required|numeric',
            'account' => 'required|numeric',
            'account_type' => 'required',
            'cpf_holder' => ['required', new CPFValidate('CPF titular do cartão')],
            'type_account' => 'required',
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

        $data['status'] = 0;
        $dataUser = ServiceUser::generateDatauser($data);
        $dataUser['user_id'] = session('user_id');
        $dataAdress = ServiceUser::generateDataAddress($data);
        $dataBank = ServiceUser::generateDataBank($data);

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
