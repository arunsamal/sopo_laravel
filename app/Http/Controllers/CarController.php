<?php

namespace App\Http\Controllers;
//namespace App\Http\Controllers\validator;

use App\Models\Car;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;
 use Illuminate\Database\QueryException ;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      try{
          $data=Car::findorfail(8);
        return response()->
        json([
            'status'=>HttpResponse::HTTP_OK,
            'message'=>'car data retrive successfully',
            'data'=>$data

        ],HttpResponse::HTTP_OK);
      }catch(\BadMethodCallException $e){
        print_r(get_class($e));
          return response()->
        json([
            'status'=>false,
            'message'=>$e->getMessage()
            ],HttpResponse::HTTP_BAD_REQUEST);
      }catch(QueryException $e){
        print_r(get_class($e));
          return response()->
        json([
            'status'=>false,
            'message'=>$e->getMessage()
            ],HttpResponse::HTTP_BAD_REQUEST);
      }catch(\Exception $e){
        print_r(get_class($e));
          return response()->
        json([
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
           return response()->
        json([
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
          return response()->
        json([
            'status'=>HttpResponse::HTTP_CREATED,
            'message'=>'cAR data insert sucessfully',
            'data'=>$data

        ],HttpResponse::HTTP_CREATED); 

    }catch(\Exception $e){
        print_r(get_class($e));
          return response()->
        json([
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
       $data =Car::WHERE('id',$id)->get();
       if($data->isEmpty()){
         return response()->
        json([
            'status'=>HttpResponse::HTTP_OK,
            'message'=>'car data not found',
            'data'=>$data

        ],HttpResponse::HTTP_OK);
       }
         return response()->
        json([
            'status'=>HttpResponse::HTTP_OK,
            'message'=>'car data retrive successfully',
            'data'=>$data

        ],HttpResponse::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $validaedata= Validator::make($request->all(),[
                 'chassis_no'=>'required',
                 'model'=>'required',
                 'color'=>'required',
                 'mgf_year'=>'required',
                 'class'=>'required'
     ]);
     if($validaedata->fails()){
           return response()->
        json([
            'status'=>HttpResponse::HTTP_BAD_REQUEST,
            'message'=>'valide error',
            'error'=>$validaedata->errors()->all()

        ],HttpResponse::HTTP_BAD_REQUEST);
     }
     $data =Car::WHERE('id',$id)->update([
        'chassis_no'=>$request->chassis_no,
        'model'=>$request->model,
        'color'=>$request->color,
        'mgf_year'=>$request->mgf_year,
         'class'=>$request->class
     ]);
          return response()->
        json([
            'status'=>HttpResponse::HTTP_OK,
            'message'=>'cAR data UPDATE sucessfully',
            'data'=>$data

        ],HttpResponse::HTTP_OK); 

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Car::WHERE('id',$id)->delete();
         return response()->
        json([
            'status'=>HttpResponse::HTTP_OK,
            'message'=>'car data delete sucessfully',
           

        ],HttpResponse::HTTP_OK);

    }
}
