<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as RoutingController;

class PaymentController extends RoutingController
{
    /**
     * Display a listing of the payments.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::with(['user', 'order'])->get();
        
        return response()->json([
            'success' => true,
            'data' => PaymentResource::collection($payments)
        ]);
    }

    /**
     * Store a newly created payment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        // Validation handled by PaymentRequest

        // Calculate total_price if not provided
        $total_price = $request->total_price;
        
        if (!$total_price) {
            if ($request->order_id) {
                $order = Order::findOrFail($request->order_id);
                
                // Determine which price to use based on is_ingredients_only flag
                $total_price = $order->is_ingredients_only ? $order->ingredients_cost : $order->total_price;
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Either order_id or total_price must be provided'
                ], 422);
            }
        }

        // Create payment
        $payment = Payment::create([
            'user_id' => $request->user_id,
            'order_id' => $request->order_id,
            'payment_method' => $request->payment_method,
            'card_number' => $request->card_number,
            'expiry_date' => $request->expiry_date,
            'security_code' => $request->security_code,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'total_price' => $total_price,
        ]);

        return response()->json([
            'success' => true,
            'data' => new PaymentResource($payment),
            'message' => 'Payment created successfully'
        ], 201);
    }

    /**
     * Display the specified payment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = Payment::with(['user', 'order'])->find($id);
        
        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new PaymentResource($payment)
        ]);
    }

    /**
     * Update the specified payment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $payment = Payment::find($id);
        
        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|exists:users,id',
            'order_id' => 'nullable|exists:orders,id',
            'payment_method' => 'sometimes|string|in:Visa_card,Meeza_card,Master_card,Vodafone_cash',
            'card_number' => 'sometimes|string|max:16',
            'expiry_date' => 'sometimes|date_format:m/y',
            'security_code' => 'sometimes|string',
            'phone_number' => 'nullable|string',
            'address' => 'sometimes|string',
            'total_price' => 'sometimes|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        
        // If order_id is being updated and total_price isn't provided, recalculate it
        if ($request->has('order_id') && !$request->has('total_price') && $request->order_id) {
            $order = Order::findOrFail($request->order_id);
            $request->merge([
                'total_price' => $order->is_ingredients_only ? $order->ingredients_cost : $order->total_price
            ]);
        }

        $payment->update($request->all());

        return response()->json([
            'success' => true,
            'data' => new PaymentResource($payment),
            'message' => 'Payment updated successfully'
        ]);
    }

    /**
     * Remove the specified payment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payment::find($id);
        
        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found'
            ], 404);
        }

        $payment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Payment deleted successfully'
        ]);
    }

    /**
     * Get payments by user.
     *
     * @param int $userId
     * @return \Illuminate\Http\Response
     */
    public function getPaymentsByUser($userId)
    {
        $payments = Payment::where('user_id', $userId)->with(['order'])->get();

        return response()->json([
            'success' => true,
            'data' => PaymentResource::collection($payments)
        ]);
    }
    
    /**
     * Calculate the payment amount for an order before creating the payment.
     * This can be used in the frontend to show the user the amount they will be charged.
     *
     * @param int $orderId
     * @return \Illuminate\Http\Response
     */
    public function calculatePaymentForOrder($orderId)
    {
        $order = Order::findOrFail($orderId);
        $amount = $order->is_ingredients_only ? $order->ingredients_cost : $order->total_price;
        
        return response()->json([
            'success' => true,
            'data' => [
                'order_id' => $orderId,
                'payment_amount' => $amount,
                'is_ingredients_only' => $order->is_ingredients_only
            ]
        ]);
    }
}