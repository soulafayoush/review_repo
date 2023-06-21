<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    use \App\Http\Traits\GeneralTrait;

    public function index()
    {
        try {
            $msg = 'All orders are here';
            $data = Order::all();
            return $this->successResponse($data, $msg);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            // Add more validation rules for other attributes if needed
        ]);

        if ($validatedData->fails()) {
            return $this->errorResponse($validatedData->errors(), 400);
        }

        $order = new Order();
        $order->fill($request->only(['name']));
        $order->save();

        $data = $order;
        $msg = 'Order created successfully';
        return $this->successResponse($data, $msg, 201);
    }

    public function show($id)
    {
        try {
            $data = Order::find($id);
            if (!$data) {
                return $this->errorResponse('No order with such id', 404);
            }

            $msg = 'Got you the order you are looking for';
            return $this->successResponse($data, $msg);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = Order::findOrFail($id);
            $data->update($request->all());

            $msg = 'Order updated successfully';
            return $this->successResponse($data, $msg);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return $this->errorResponse('No order with such id', 404);
        } catch (\Exception $ex) {
            return $this->errorResponse('An error occurred while updating the order', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $data = Order::findOrFail($id);
            $data->delete();

            $msg = 'Order deleted successfully';
            return $this->successResponse($data, $msg);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return $this->errorResponse('No order with such id', 404);
        } catch (\Exception $ex) {
            return $this->errorResponse('An error occurred while deleting the order', 500);
        }
    }
}
