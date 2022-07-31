<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\ContactUs;
use App\Models\Course;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $this->SEOToolsMethods();
        $sliders = Banner::where('type', 'slider')->where('is_active', 1)->orderBy('priority')->get();
        $indexTopBanners = Banner::where('type', 'index-top')->where('is_active', 1)->orderBy('priority')->get();
        $indexBottomBanners = Banner::where('type', 'index-bottom')->where('is_active', 1)->orderBy('priority')->get();
        $courses = Course::where('is_active', 1)->latest()->paginate(10);
        return view('home.index', compact('sliders', 'indexTopBanners', 'indexBottomBanners', 'courses'));
    }
    public function aboutUs()
    {
        $this->SEOToolsMethods();
        $TopBanners = Banner::where('type', 'index-top')->where('is_active', 1)->orderBy('priority')->get();
        return view('home.about-us', compact('TopBanners'));
    }
    public function contactUs()
    {
        $this->SEOToolsMethods();
        $setting = Setting::findOrFail(1);
        return view('home.contact-us', compact('setting'));
    }
    public function banner_show()
    {
        $banner_id = $_REQUEST['banner'];
        $banner_info = Banner::where('id',$banner_id)->first();
        return view('home.banner-show',compact('banner_info'));
    }
    public function contactUsForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:4|max:50',
            'email' => 'required|email',
            'subject' => 'required|string|min:4|max:100',
            'text' => 'required|string|min:4|max:3000',
        ]);

        ContactUs::create([
            'name' => $request->name,
            'email' =>  $request->email,
            'subject' =>  $request->subject,
            'text' =>  $request->text,
        ]);

        alert()->success('پیام شما با موفقیت ثبت شد', 'با تشکر');
        return redirect()->back();
    }
    public function SEOToolsMethods()
    {
        SEOTools::setTitle('Hamrah Software');
        SEOTools::setDescription('در خانه بیاموزید');

        SEOTools::setCanonical('https://hamrahsoftware.ir/courses/all');
        SEOTools::opengraph()->setUrl('http://hamrahsoftware.ir');
        SEOTools::opengraph()->setDescription('Hamrah Software');
        // SEOTools::opengraph()->addProperty('description', 'articles');
        SEOTools::twitter()->setSite('@HamrahSoftware');
        SEOTools::jsonLd()->addImage('/img/MainLogo2.png');
    }
}
