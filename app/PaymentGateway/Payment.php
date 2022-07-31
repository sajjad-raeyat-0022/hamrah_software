<?php

namespace App\PaymentGateway;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Notifications\PaymentReceipt;
use Illuminate\Support\Facades\DB;

class Payment{
    public function createOrder($addressId, $amounts, $token, $gateway_name)
    {
        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => auth()->id(),
                'address_id' => $addressId,
                'coupon_id' => session()->has('coupon' . '-' . auth()->id()) ? session()->get('coupon' . '-' . auth()->id() . '.id') : null,
                'total_amount' => $amounts['total_amount'],
                'delivery_amount' => $amounts['delivery_amount'],
                'coupon_amount' => $amounts['coupon_amount'],
                'paying_amount' => $amounts['paying_amount'],
                'payment_type' => 'online',
            ]);

            foreach (\Cart::session(auth()->id())->getContent() as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'course_id' => $item->associatedModel->id,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'sum' => ($item->quantity * $item->price),
                ]);
            }

            Transaction::create([
                'user_id' => auth()->id(),
                'order_id' => $order->id,
                'amount' => $amounts['paying_amount'],
                'token' => $token,
                'gateway_name' => $gateway_name,
            ]);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return ['error' => $ex->getMessage()];
        }

        return ['success' => 'success'];
    }
    public function updateOrder($token, $refId)
    {
        try {
            DB::beginTransaction();

            $transaction = Transaction::where('token', $token)->firstOrFail();

            $transaction->update([
                'status' => 1,
                'ref_id' => $refId,
            ]);

            $order = Order::findOrFail($transaction->order_id);
            $order->update([
                'payment_status' => 1,
                'status' => 1,
            ]);

            auth()->user()->notify(new PaymentReceipt($order->id,$order->paying_amount,$refId));

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return ['error' => $ex->getMessage()];
        }

        return ['success' => 'success'];
    }
}
