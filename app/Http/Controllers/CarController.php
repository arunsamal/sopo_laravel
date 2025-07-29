<?php

namespace App\Http\Controllers;
//namespace App\Http\Controllers\validator;

use App\Models\Car;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Validator;
 use Illuminate\Database\QueryException ;
 use App\Http\Controllers\HTTP_OK;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
                $data=Car::all();
                return response()->json([
                        'status'=>HttpResponse::HTTP_OK,
                        'message'=>'car data retrive successfully',
                        'data'=>$data
                ],HttpResponse::HTTP_OK);
        }catch(\BadMethodCallException $e){
            return response()->json([
                    'status'=>false,
                    'message'=>$e->getMessage()
            ],HttpResponse::HTTP_BAD_REQUEST);
        }catch(QueryException $e){
          return response()->json([
                'status'=>false,
                'message'=>$e->getMessage()
            ],HttpResponse::HTTP_BAD_REQUEST);
        }catch(\Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>$e->getMessage()
            ],HttpResponse::HTTP_BAD_REQUEST);
      }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            
            $validaedata= Validator::make($request->all(),[
                        'chassis_no'=>'required',
                        'model'=>'required',
                        'color'=>'required',
                        'mgf_year'=>'required',
                        'class'=>'required'
            ]);
             if($validaedata->fails()){
                 return response()-> json([
                        'status'=>HttpResponse::HTTP_BAD_REQUEST,
                        'message'=>'valide error',
                        'error'=>$validaedata->errors()->all()
                ],HttpResponse::HTTP_BAD_REQUEST);
             }
                $data =Car::create([
                    'chassis_no'=>$request->chassis_no,
                    'model'=>$request->model,
                    'color'=>$request->color,
                    'mgf_year'=>$request->mgf_year,
                    'class'=>$request->class
               ]);
                    return response()->json([
                        'status'=>HttpResponse::HTTP_CREATED,
                        'message'=>'cAR data insert sucessfully',
                        'data'=>$data

                    ],HttpResponse::HTTP_CREATED); 
        }catch(\Exception $e){
          return response()->json([
                'status'=>false,
                'message'=>$e->getMessage()
            ],HttpResponse::HTTP_BAD_REQUEST);
         }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      try{
            $data =Car::where('id',$id)->get();
             if($data->isEmpty()){
                return response()->json([
                    'status'=> false,
                    'message'=>'car data not found',
                ],HttpResponse::HTTP_BAD_REQUEST);
            }
            return response()->json([
                    'status'=> true,
                    'message'=>'car data retrive successfully',
                    'data'=>$data
                ],HttpResponse::HTTP_OK);
        } catch(\Exception $e){
                return response()->json([
                    'status'=>false,
                    'message'=>$e->getMessage()
                ],HttpResponse::HTTP_BAD_REQUEST);

        }
       
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
          $validaedata= Validator::make($request->all(),[
                 'chassis_no'=>'required',
                 'model'=>'required',
                 'color'=>'required',
                 'mgf_year'=>'required',
                 'class'=>'required'
           ]);
            if($validaedata->fails()){
            return response()-> json([
                'status'=>HttpResponse::HTTP_BAD_REQUEST,
                'message'=>'valide error',
                'error'=>$validaedata->errors()->all()

            ],HttpResponse::HTTP_BAD_REQUEST);
           }
            $cars =Car::WHERE('id',$id)->update([
                    'chassis_no'=>$request->chassis_no,
                    'model'=>$request->model,
                    'color'=>$request->color,
                    'mgf_year'=>$request->mgf_year,
                    'class'=>$request->class
            ]);
              return response()->json([
                                    'status'=>HttpResponse::HTTP_OK,
                                    'message'=>'car updated successfully',
                                    'data'=>$cars
                                   ],HttpResponse::HTTP_OK);
        }catch(\Exception $e){
                 return response()->json([
                 'status'=>HttpResponse::HTTP_BAD_REQUEST,
                'message'=>'Error error',
            ]);

        }
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

     try{
          Car::WHERE('id',$id)->delete();
           return response()-> json([
               'status'=>HttpResponse::HTTP_OK,
                'message'=>'car data delete sucessfully',
            ],HttpResponse::HTTP_OK);

        }catch(\Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>$e->getMessage()
            ],HttpResponse::HTTP_BAD_REQUEST);
        }
       
    }
}
