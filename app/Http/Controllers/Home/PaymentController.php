<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\PaymentGateway\Pay;
use App\PaymentGateway\Zarinpal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'payment_method' => 'required',
            'address_id' => 'required',
        ]);

        if ($validator->fails()) {
            alert()->error('اطلاعات به درستی انتخاب نشده اند', 'دقت کنید')->persistent('باشه');
            return redirect()->back();
        }

        $checkCart = $this->checkCart();
        if (array_key_exists('error', $checkCart)) {
            alert()->error($checkCart['error'], 'دقت کنید');
            return redirect()->route('index');
        }

        $amounts = $this->getAmounts();
        if (array_key_exists('error', $amounts)) {
            alert()->error($amounts['error'], 'دقت کنید');
            return redirect()->route('index');
        }

        if ($request->payment_method == 'pay') {
            $payGateway = new Pay();
            $payGatewayResult = $payGateway->send($amounts, $request->address_id);
            if (array_key_exists('error', $payGatewayResult)) {
                alert()->error($payGatewayResult['error'], 'دقت کنید')->persistent('باشه');
                return redirect()->back();
            } else {
                return redirect()->to($payGatewayResult['success']);
            }
        }

        if ($request->payment_method == 'zarinpal') {
            $zarinpalGateway = new Zarinpal();
            $zarinpalGatewayResult = $zarinpalGateway->send($amounts, 'سفارشات', $request->address_id);
            if (array_key_exists('error', $zarinpalGatewayResult)) {
                alert()->error($zarinpalGatewayResult['error'], 'دقت کنید')->persistent('باشه');
                return redirect()->back();
            } else {
                return redirect()->to($zarinpalGatewayResult['success']);
            }
        }
        alert()->error('درگاه پرداخت انتخابی اشتباه میباشد', 'دقت کنید')->persistent('باشه');
        return redirect()->back();
    }

    public function paymentVerify(Request $request, $gatewayName)
    {

        if ($gatewayName == 'pay') {
            $payGateway = new Pay();
            $payGatewayResult = $payGateway->verify($request->token, $request->status);
            if (array_key_exists('error', $payGatewayResult)) {
                alert()->error($payGatewayResult['error'], 'دقت کنید')->persistent('باشه');
                return redirect()->back();
            } else {
                alert()->success($payGatewayResult['success'], 'با تشکر')->persistent('باشه');
                return redirect()->route('index');
            }
        }
        if ($gatewayName == 'zarinpal') {
            $amounts = $this->getAmounts();
            if (array_key_exists('error', $amounts)) {
                alert()->error($amounts['error'], 'دقت کنید');
                return redirect()->route('index');
            }

            $zarinpalGateway = new Zarinpal();
            $zarinpalGatewayResult = $zarinpalGateway->verify($request->Authority, $amounts['paying_amount']);
            if (array_key_exists('error', $zarinpalGatewayResult)) {
                alert()->error($zarinpalGatewayResult['error'], 'دقت کنید')->persistent('باشه');
                return redirect()->back();
            } else {
                alert()->success($zarinpalGatewayResult['success'], 'با تشکر')->persistent('باشه');
                return redirect()->route('index');
            }
        }
        alert()->error('مسیر بازگشت از درگاه پرداخت اشتباه میباشد', 'دقت کنید')->persistent('باشه');
        return redirect()->route('user.users_profile.orders.checkout');
    }



    public function checkCart()
    {
        if (\Cart::session(auth()->id())->isEmpty()) {
            return ['error' => 'سبد خرید شما خالی میباشد'];
        }
        foreach (\Cart::session(auth()->id())->getContent() as $item) {

            $price = $item->associatedModel->is_sale ? $item->associatedModel->sale_price : $item->associatedModel->price;

            if ($item->price != $price) {
                \Cart::session(auth()->id())->clear();
                return ['error' => 'قیمت محصول تغییر پیدا کرد'];
            }
            return ['success' => 'success'];
        }
    }

    public function getAmounts()
    {
        if (session()->has('coupon' . '-' . auth()->id())) {
            $checkCoupon = check_Coupon(session()->get('coupon' . '-' . auth()->id() . '.code'));
            if (array_key_exists('error', $checkCoupon)) {
                return $checkCoupon;
            }
        }

        return [
            'total_amount' => (\Cart::session(auth()->id())->getTotal() + cartTotalSaleAmount()),
            'delivery_amount' => cartTotalDeliveryAmount(),
            'coupon_amount' => session()->has('coupon' . '-' . auth()->id()) ? session()->get('coupon' . '-' . auth()->id() . '.amount') : 0,
            'paying_amount' => cartTotalAmount(),
        ];
    }
}
