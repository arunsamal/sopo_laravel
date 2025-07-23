<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signUp(Request $request){
    $validationUser = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required |email|unique:users,email',
            'password'=>'required'

      ]
    );
    if($validationUser->fails()){
        return response()->json([
               'status'=>false,
               'message'=>'validation error',
               'error'=>$validationUser->errors()->all()
        ],HttpResponse::HTTP_BAD_REQUEST);
    }
  $data = User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>$request->password
    ]);
   
        return response()->json([
               'status'=>true,
               'message'=>'validation signup successfully',
               'data'=>$data
        ],HttpResponse::HTTP_OK);
   
    
    }

    //login
    public function login(Request $request){
        try{
              $validationUser = Validator::make(
              $request->all(),[
              'email'=>'required |email',
              'password'=>'required'
              ]
              );
            if($validationUser->fails()){
               return response()->json([
               'status'=>false,
               'message'=>'validation error',
               'error'=>$validationUser->errors()->all()
              ],HttpResponse::HTTP_BAD_REQUEST);
            }
          if(Auth::attempt(['email'=> $request->email,'password'=> $request->password])){
            $generatredToken=Auth::user()->createToken('API_token')->plainTextToken;
              return response()->json([
               'status'=>true,
               'message'=>'user login successfully',
              'token'=>$generatredToken,
              'token_type'=>'bearer'
              ],HttpResponse::HTTP_OK);
            }
        }catch(\Exception $e){
            
             return response()->json([
                'message'=>$e->getMessage()
             ],404);
            }
        
    }
    public function logout(Request $request){
       $user = $request->user();
       $user->tokens()->delete();
       return response()->json([
               'status'=>true,
               'message'=>'user logout successfully',
               ],HttpResponse::HTTP_OK);
        
    }

}