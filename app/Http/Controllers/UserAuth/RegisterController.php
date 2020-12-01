<?php

namespace App\Http\Controllers\UserAuth;

use App\Http\Controllers\Controller;
use App\Rules\CPFValidate;
use App\Rules\PhoneValidate;
use App\Services\UserService;
use App\User;
use DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Validator;

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
        if (isset($data['hasPix']) && $data['hasPix'] == 1) {
            $type = 'required';
            $key = 'required';
        } else {
            $type = 'nullable';
            $key = 'nullable';
        }
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'cpf' => ['required', new CPFValidate("CPF"), 'unique:users'],
            'rg' => 'required',
            'cellphone' => ['required', 'string', 'max:255', new PhoneValidate()],
            'zip_code' => 'required',
            'street' => 'required',
            'number' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required',
            'type' => $type,
            'key' => $key,
            'bank_code' => 'required|numeric',
            'agency' => 'required|numeric',
            'account' => 'required|numeric',
            'account_type' => 'required',
            'cpf_holder' => ['required', new CPFValidate('CPF titular do cartão')],
            'type_account' => 'required',
            'name_holder' => 'required',
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
        $userService = new UserService();
        $data['status'] = 0;
        $dataUser = $userService->generateDataUser($data);
        $dataUser['user_id'] = session('user_id');
        $dataAddress = $userService->generateDataAddress($data);
        $dataBank = $userService->generateDataBank($data);
        if (isset($data['hasPix']) && $data['hasPix'] == 1) {
            $dataPix = [
                'key' => $data['key'],
                'type' => $data['type'],
            ];
        }
        DB::beginTransaction();
        try {
            $user = User::create($dataUser);
            $user->address()->create($dataAddress);
            $user->dataBank()->create($dataBank);
            if (isset($data['hasPix']) && $data['hasPix'] == 1) {
                $user->pixKeys()->create($dataPix);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            request()
                ->session()
                ->flash('error', 'Tivemos um problema no servidor: ', $e->getMessage());
        }
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
