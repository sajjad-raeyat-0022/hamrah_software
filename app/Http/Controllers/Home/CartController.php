<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\State;
use App\Models\CourseMovie;
use App\Models\Viewmovie;
use App\Models\UserAddress;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
        ]);
        $course = Course::findOrFail($request->course_id);

        if (auth()->check()) {
            if (Cart::session(auth()->id())->get($course->id) == null) {
                Cart::session(auth()->id())->add(array(
                    'id' => $course->id,
                    'name' => $course->name,
                    'price' => $course->is_sale ? $course->sale_price : $course->price,
                    'quantity' => 1,
                    'attributes' => array(),
                    'associatedModel' => $course,

                ));
                alert()->success('دوره با موفقیت به سبد خرید شما اضافه شد', 'با تشکر');
                return redirect()->back();
            } else {
                alert()->warning('دوره مورد نظر از قبل در سبد خرید شما وجود دارد', 'دقت کنید')->persistent('باشه');
                return redirect()->back();
            }
        } else {
            alert()->warning('برای افزودن به لیست خرید نیاز است ابتدا وارد سایت شوید', 'دقت کنید')->persistent('باشه');
            return redirect()->back();
        }
    }
    public function index()
    {
        return view('user.users_profile.cart');
    }
    public function update(Request $request)
    {
        $request->validate([
            'type_cart' => 'required',
        ]);
        foreach ($request->type_cart as $key => $type_cart) {
            \Cart::session(auth()->id())->update($key,array(
                'type_cart' => $type_cart,
            ));
        }
        alert()->success('سبد خرید شما با موفقیت ویرایش شد', 'با تشکر');
        return redirect()->back();
    }
    public function remove($rowId)
    {
        Cart::session(auth()->id())->remove($rowId);
        alert()->success('دوره مورد نظر از سبد خرید شما حذف شد', 'با تشکر');
        return redirect()->back();
    }
    public function clear()
    {
        Cart::session(auth()->id())->clear();
        alert()->warning('سبد خرید شما حذف شد', 'با تشکر');
        return redirect()->back();
    }
    public function checkCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required'
        ]);

        // if (!auth()->check()) {
        //     alert()->error('برای استفاده از کد تخفیف نیاز هست ابتدا وارد وب سایت شوید', 'دقت کنید');
        //     return redirect()->back();
        // }

        $result = check_Coupon($request->code);
        // dd($result);

        if (array_key_exists('error', $result)) {
            alert()->error($result['error'], 'دقت کنید');
        } else {
            alert()->success($result['success'], 'باتشکر');
        }
        return redirect()->back();
    }
    public function checkout()
    {
        if(\Cart::session(auth()->id())->isEmpty()){
            alert()->warning('سبد خرید شما خالی است', 'دقت کنید');
            return redirect()->route('index');
        }
        $addresses = UserAddress::where('user_id', auth()->id())->get();
        $states = State::all();
        return view('user.users_profile.checkout',compact('addresses' , 'states'));
    }
    public function usersOrder()
    {
        $orders = Order::where('user_id' , auth()->id())->latest()->paginate(5);
        return view('user.users_profile.orders' , compact('orders'));
    }
    public function usersOrderItems()
    {
        $orders = Order::where('user_id' , auth()->id())->latest()->paginate(5);
        return view('user.users_profile.orderItems' , compact('orders'));
    }
    public function usersOrderItemsMovie(Course $course)
    {
        
        return view('user.users_profile.orderItemsMovie' , compact('course'));
    }
    public function add_view(CourseMovie $movie)
    {
        $view_movie = CourseMovie::where('id',$movie->id)->first();
        // $user_orders = Order::where('user_id' , auth()->id())->get();
        // foreach($user_orders as $key => $user_order){
        //     $user_order_item = OrderItem::where('course_id',$movie->id)->first();
        // }
        // $view_movie->update([
        //     'view' => 1
        // ]);
        $view = Viewmovie::where('user_id',auth()->user()->id)->where('orderitem_id',$movie->id)->where('view',1)->first();
        if(empty($view)){
            Viewmovie::create([
                'user_id' => auth()->user()->id,
                'orderitem_id' => $movie->id,
                'view' => 1,
            ]);
        }
        alert()->success('مشاهده ویدئو دوره برای شما ثبت شد', 'با تشکر');
        return redirect()->back();
    }
}
