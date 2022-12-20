<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Validator;

class AuthController extends BaseController
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth = Auth::user();
            $sucess['token'] = $auth->createToken('LaravelSanctumAuth')->plainTextToken;
            $sucess['name'] = $auth->name;
            return $this->handleResponse($sucess, 'Usuario Logado!');
        } else {
            return $this->handleError('Não autorizado.', ['error' => 'Não autorizado']);
        }
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return $this->handleError($validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $sucess['token'] = $user->createToken('LaravelSanctumAuth')->plainTextToken;
        $sucess['name'] = $user->name;

        return $this->handleResponse($sucess, 'Usuario registrado com sucesso');
    }
}
