<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
public $successStatus = 200;
/**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){

        //if email and password are authenticated
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            //ger user object
            $user = Auth::user();
            //create a success payload and create a valid api token
            $success['token'] =  $user->createToken('MyApp')-> accessToken;

            //return a successful json response
            return response()->json(['success' => $success], $this-> successStatus);
        }
        else{
          //else return an error unauthorized
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        //we can use laravel validator functionality for -
        //validating our register
          $validator = Validator::make($request->all(), [
              'name' => 'required',
              'email' => 'required|unique:users|email',
              'password' => 'required',
              'c_password' => 'required|same:password',
            ]);

            //if the validator fails return error payload
              if ($validator->fails()) {
                        return response()->json(['error'=>$validator->errors()], 401);
                    }

          //get the request data
          $input = $request->all();

          //create a new user and api token
          $input['password'] = bcrypt($input['password']);
          $user = User::create($input);
          $success['token'] =  $user->createToken('MyApp')-> accessToken;
          $success['name'] =  $user->name;

        // return a successful payload
        return response()->json(['success'=>$success], $this-> successStatus);
  }

}
