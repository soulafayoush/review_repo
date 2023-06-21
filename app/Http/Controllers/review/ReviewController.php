<?php

namespace App\Http\Controllers\Review;

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
    use \App\Http\Traits\GeneralTrait;

    public function __construct()
    {
        $this->authorizeResource(Review::class, 'review');
    }

    public function index()
    {
        try {
            $msg = 'All reviews by users of products right here';
            $data = Review::with('user', 'product')->get();
            return $this->successResponse($data, $msg);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {$productID = $request->product_id;
        $userID = Auth::id();
        
        // التحقق من عدم وجود مراجعة سابقة بنفس الـ product_id و user_id
        if (Review::where('product_id', $productID)->where('user_id', $userID)->exists()) {
            // تم إنشاء مراجعة سابقة لنفس المنتج بواسطة نفس المستخدم
            // يمكنك إعادة رسالة الخطأ المناسبة هنا أو اتخاذ إجراء آخر
            return $this->errorResponse('تم إضافة مراجعة لهذا المنتج بالفعل', 409);
        }
        
        // إنشاء المراجعة
        $review = new Review();
        $review->fill($request->only(['user_id', 'star', 'comment', 'product_id']));
        $review->save();
        
        $data = $review;
        $msg = 'تم إنشاء المراجعة بنجاح';
        return $this->successResponse($data, $msg, 201);
        
    
    }

    public function show($id)
    {
        try {
            $data = Review::with('user', 'product')->find($id);
            if (!$data) {
                return $this->errorResponse('No product with such id', 404);
            }

            $msg = 'Got you the product you are looking for';
            return $this->successResponse(new ReviewResource($data), $msg);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = Review::findOrFail($id);
            $data->update($request->all());

            $msg = 'تم تحديث المراجعة بنجاح';
            $response = new ReviewResource($data);
            return $this->successResponse($response, $msg);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return $this->errorResponse('لا توجد مراجعة بهذا الرقم', 404);
        } catch (\Exception $ex) {
            return $this->errorResponse('حدث خطأ أثناء تحديث المراجعة', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $data = Review::findOrFail($id);
            $data->delete();

            $msg = 'تم حذف المراجعة بنجاح';
            $response = new ReviewResource($data);
            return $this->successResponse($response, $msg);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return $this->errorResponse('لا توجد مراجعة بهذا الرقم', 404);
        } catch (\Exception $ex) {
            return $this->errorResponse('حدث خطأ أثناء حذف المراجعة', 500);
        }
    }

    public function filterReviewByProduct($product_id)
    {
        try {
            $data = Review::whereHas('product', function ($query) use ($product_id) {
                $query->where('id', $product_id);
            })->with('user', 'product')->get();

            $msg = 'تم الحصول على البيانات بنجاح';
            $response = new ReviewCollection($data);
            return $this->successResponse($response, $msg);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function filterReviewByUser($user_id)
    {
        try {
            $data = Review::whereHas('user', function ($query) use ($user_id) {
                $query->where('id', $user_id);
            })->with('user', 'product')->get();

            $msg = 'تم الحصول على البيانات بنجاح';
            $response = new ReviewCollection($data);
            return $this->successResponse($response, $msg);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }
}
