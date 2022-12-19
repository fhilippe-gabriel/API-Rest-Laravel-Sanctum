<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{
    public function register(Request $request){

        $validator = Validator::make($request->a11(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
     ]);

     if ($valigator->fails()){
     return $this-shandletrror($validator-perrors());
    }
}
}
