<?php

use App\Models\City;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\State;
use Artesaos\SEOTools\Facades\SEOTools;
use Carbon\Carbon;

if (!function_exists('generateFileName')) {
    function generateFileName($name)
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;
        $hour = Carbon::now()->hour;
        $minute = Carbon::now()->minute;
        $second = Carbon::now()->second;
        $microsecond = Carbon::now()->microsecond;
        return $year . '_' . $month . '_' . $day . '_' . $hour . '_' . $minute . '_' . $second . '_' . $microsecond . '_' . $name;
    }
}

if (!function_exists('convertShamsiToGregorianDate')) {
    function convertShamsiToGregorianDate($date)
    {
        if ($date == null) {
            return null;
        }
        $pattern = "/[-\s]/";
        $shamsiDateSplit = preg_split($pattern, $date);

        $arrayGergorianDate = verta()->getGregorian($shamsiDateSplit[0], $shamsiDateSplit[1], $shamsiDateSplit[2]);

        return implode("-", $arrayGergorianDate) . " " . $shamsiDateSplit[3];
    }
}


if (!function_exists('cartTotalSaleAmount')) {
    function cartTotalSaleAmount()
    {
        $cartTotalSaleAmount = 0;
        foreach (\Cart::session(auth()->id())->getContent() as $item) {
            if ($item->associatedModel->is_sale) {
                $cartTotalSaleAmount += $item->quantity * ($item->associatedModel->price - $item->associatedModel->sale_price);
            }
        }

        return $cartTotalSaleAmount;
    }
}



if (!function_exists('cartTotalDeliveryAmount')) {
    function cartTotalDeliveryAmount()
    {
        $cartTotalDeliveryAmount = 0;
        $c = \Cart::session(auth()->id())->getContent()->count();
        foreach (\Cart::session(auth()->id())->getContent() as $item) {
            if ($item->type_cart == 2) {
                $cartTotalDeliveryAmount += $item->associatedModel->delivery_amount;
            } else {
                $cartTotalDeliveryAmount = 0;
            }
        }
        if ($cartTotalDeliveryAmount != 0) {
            $cartTotalDeliveryAmount /= $c;
        }

        return $cartTotalDeliveryAmount;
    }
}


if (!function_exists('cartTotalAmount')) {
    function cartTotalAmount()
    {
        // dd(session()->get('coupon'.'-'.auth()->id().'.amount'));
        if (session()->has('coupon' . '-' . auth()->id())) {
            if (session()->get('coupon' . '-' . auth()->id() . '.amount') > (\Cart::session(auth()->id())->getTotal() + cartTotalDeliveryAmount())) {
                return 0;
            } else {
                return (\Cart::session(auth()->id())->getTotal() + cartTotalDeliveryAmount()) - session()->get('coupon' . '-' . auth()->id() . '.amount');
            }
        } else {
            return \Cart::session(auth()->id())->getTotal() + cartTotalDeliveryAmount();
        }
    }
}


if (!function_exists('check_Coupon')) {
    function check_Coupon($code)
    {
        $coupon = Coupon::where('code', $code)->where('expired_at', '>', Carbon::now())->first();

        if ($coupon == null) {
            session()->forget('coupon' . '-' . auth()->id());
            return ['error' => 'کد تخفیف وارد شده وجود ندارد'];
        }

        if (Order::where('user_id', auth()->id())->where('coupon_id', $coupon->id)->where('payment_status', 1)->exists()) {
            session()->forget('coupon' . '-' . auth()->id());
            return ['error' => 'شما قبلا از این کد تخفیف استفاده کرده اید'];
        }

        if (session()->has('coupon' . '-' . auth()->id())) {
            // dd(\Cart::session(auth()->id())->getContent());
            session()->forget('coupon' . '-' . auth()->id());
            // return ['error' => 'شما قبلا از یک کد تخفیف استفاده کرده اید'];
        }
        if ($coupon->getRawOriginal('type') == 'amount') {
            session()->put('coupon' . '-' . auth()->id(), ['id' => $coupon->id, 'code' => $coupon->code, 'amount' => $coupon->amount]);
        } else {
            $total = \Cart::session(auth()->id())->getTotal();

            $amount = (($total * $coupon->percentage) / 100) > $coupon->max_percentage_amount ? $coupon->max_percentage_amount : (($total * $coupon->percentage) / 100);

            session()->put('coupon' . '-' . auth()->id(), ['id' => $coupon->id, 'code' => $coupon->code, 'amount' => $amount]);
        }

        return ['success' => 'کد تخفیف برای شما ثبت شد'];
    }
}


if (!function_exists('state_name')) {
    function state_name($stateId)
    {
        return State::findOrFail($stateId)->name;
    }
}



if (!function_exists('city_name')) {
    function city_name($cityId)
    {
        return City::findOrFail($cityId)->name;
    }
}
