<?php

namespace App\Http\Controllers\review;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewCollection;
use App\Http\Resources\ReviewResource;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    //

    public function index()
    {
       try{
           $msg='all review by user of productc Right Here';
           $data=Review::with('user,product')->get();
           return $this->successResponse($data,$msg);
       }
       catch (\Exception $ex){
           return $this->errorResponse($ex->getMessage(),500);
       }
    }




    public function store(Request $request)
    {

        $validator=Validator::make($request->all(),[
            'user_id'=>'required|integer',
            'user_product'=>'required|integer',
                'comment'=>'required|string',
                'star'=>'required|numeric'
            ]
        );
                if($validator->fails()){
            return $this->errorResponse($validator->errors(),422);
        }
      try {
        $product = Product::firstOrCreate([
            'product_name' => $request->product_name
            ]);
            $review = Review::create($request->all());
            $review->user()->associate(Auth::user())->save();
            $review->product()->associate($product)->save();
           $data=$review;
           $msg='review is created successfully';
            return $this->successResponse($data,$msg,201);
        }
        catch (\Exception $ex)
        {
            return $this->errorResponse($ex->getMessage(),500);
        }
    }

    public function show($id)
    {

        try{
            $data=Review::with('user,product')->find($id);
            if(!$data)
                return $this->errorResponse('No product with such id',404);


            $msg='Got you the product you are looking for';
            return $this->successResponse(new ReviewResource($data),$msg);
        }
        catch (\Exception $ex){
            return $this->errorResponse($ex->getMessage(),500);
        }
    }
    public function update(Request $request, $id)
    {

        try{
            $data=Review::find($id);
            if(!$data)
                return $this->errorResponse('No review with such id',404);

            $data->update($request->all());
            $data->save();
            $msg='The review is updated successfully';
            return $this->successResponse(new ReviewResource($data),$msg);
        }
        catch (\Exception $ex){
            return $this->errorResponse($ex->getMessage(),500);
        }
    }
    public function destroy($id)
    {
        try{
            $data=Review::find($id);
            if(!$data)
                return $this->errorResponse('No review with such id',404);

            $data->delete();
            $msg='The review is deleted successfully';
            return $this->successResponse(new ReviewResource( $data),$msg);
        }
        catch (\Exception $ex){
            return $this->errorResponse($ex->getMessage(),500);
        }}

        public function  filterreviewByproduct($product_id)
        {
            try {
                $data= Review::whereRelation('product','product_id','like',$product_id.'%')->with('user,product')->get();
                $msg='Got data Successfully';
                return $this->successResponse(new ReviewCollection($data),$msg);
            }
        catch (\Exception $ex)
        { return $this->errorResponse($ex->getMessage(),500); }
        }
        public function  filterreviewByuser($user_id)
        {
            try {
                $data= Review::whereRelation('user','user_id','like',$user_id.'%')->with('user,product')->get();
                $msg='Got data Successfully';
                return $this->successResponse(new ReviewCollection($data),$msg);
            }
        catch (\Exception $ex)
        { return $this->errorResponse($ex->getMessage(),500); }
        }
    }
    



