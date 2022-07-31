<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\CouponsController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CourseMovieController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\OTPAuthController;
use App\Http\Controllers\User\CompareController;
use App\Http\Controllers\Home\CartController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\CategoryController as HomeCategoryController;
use App\Http\Controllers\Home\CourseController as HomeCourseController;
use App\Http\Controllers\Home\CommentController as HomeCommentController;
use App\Http\Controllers\Home\PaymentController;
use App\Http\Controllers\Home\SitemapController;
use App\Http\Controllers\User\ScoreController;
use App\Http\Controllers\User\AddressController;
use App\Http\Controllers\User\ChatController;
use App\Http\Controllers\User\FavoritelistController;
use App\Http\Controllers\User\UserProfileController;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes(['verify'=>true]);

Route::get('/admin-panel/dashboard', [AdminController::class , 'index'])->name('admin.dashboard')->middleware('permission:management|dashboard-management');

Route::get('/inaccessible', function () {
    return view('auth.inaccessible');
})->name('inaccessible');

Route::prefix('admin-panel/management')->name('admin.')->middleware(['role:management|master|ta-master' , 'verified'])->group(function(){

    Route::resource('attributes', AttributeController::class)->middleware('permission:attributes');
    Route::resource('categories', CategoryController::class)->middleware('permission:categories');
    Route::resource('tags', TagController::class)->middleware('permission:tags');
    Route::resource('courses', CourseController::class)->middleware('permission:courses');
    Route::resource('banners', BannerController::class)->middleware('permission:banners');
    Route::resource('comments', CommentController::class)->middleware('permission:comment-management');
    Route::resource('coupons', CouponsController::class)->middleware('permission:coupon-management');
    Route::resource('orders', OrderController::class)->middleware('permission:orders-management');
    Route::resource('transactions', TransactionController::class)->middleware('permission:transaction-management');
    Route::resource('users', UserController::class)->middleware('permission:user-management');
    Route::resource('permissions', PermissionController::class)->middleware('permission:permission-management');
    Route::resource('roles', RoleController::class)->middleware('permission:roles-management');
    Route::resource('exams', ExamController::class)->middleware('permission:roles-management');

    Route::get('/comments/{comment}/change-approve' ,[CommentController::class , 'changeApprove'])->name('comments.change-approve');

    // Get Category Attributes
    Route::get('/category-attributes/{category}' ,[CategoryController::class , 'getCategoryAttributes']);

    // Edit course Image
    Route::get('/courses/{course}/movies-edit' ,[CourseMovieController::class , 'edit'])->name('courses.movies.edit')->middleware('permission:edit-course');
    Route::delete('/courses/{course}/movies-destroy' ,[CourseMovieController::class , 'destroy'])->name('courses.movies.destroy')->middleware('permission:edit-course');
    Route::post('/courses/{course}/movies-set' ,[CourseMovieController::class , 'set'])->name('courses.movies.set')->middleware('permission:edit-course');
    Route::post('/courses/{course}/movies-set-primary-video' ,[CourseMovieController::class , 'set_primary_video'])->name('courses.movies.set_primary_video')->middleware('permission:edit-course');
    Route::post('/courses/{course}/movies-add' ,[CourseMovieController::class , 'add'])->name('courses.movies.add')->middleware('permission:edit-course');

    // Edit course Category
    Route::get('/courses/{course}/category-edit' ,[CourseController::class , 'editCategory'])->name('courses.category.edit')->middleware('permission:edit-category');
    Route::put('/courses/{course}/category-update' ,[CourseController::class , 'updateCategory'])->name('courses.category.update')->middleware('permission:edit-category');

    // Edit Exam
    // Route::delete('/exams/{question}/remove-question' ,[ExamController::class , 'remove_question'])->name('exams.remove_question')->middleware('permission:remove-question');
    Route::post('/exams/{exam}/add-question' ,[ExamController::class , 'add_question'])->name('exams.add_question')->middleware('permission:add-question');
});

Route::prefix('/user-profile')->name('user.')->group(function(){
    Route::get('/',[UserProfileController::class , 'index'])->name('users_profile.index')->middleware('verified');
    Route::put('/update',[UserProfileController::class , 'updateUser'])->name('users_profile.update')->middleware('verified');

    Route::get('/comments',[HomeCommentController::class , 'usersProfileIndex'])->name('users_profile.comments')->middleware('verified');

    Route::get('/favoritelist',[FavoritelistController::class , 'usersFavoritelist'])->name('users_profile.favoritelist')->middleware('verified');

    Route::get('/compare',[CompareController::class , 'index'])->name('users_profile.compare')->middleware('verified');

    Route::get('/cart' , [CartController::class , 'index'])->name('users_profile.cart')->middleware('verified');
    Route::put('/cart' , [CartController::class , 'update'])->name('users_profile.cart.update')->middleware('verified');
    Route::get('/remove-frome-cart/{rowId}' , [CartController::class , 'remove'])->name('users_profile.cart.remove')->middleware('verified');
    Route::get('/clear-cart' , [CartController::class , 'clear'])->name('users_profile.cart.clear')->middleware('verified');
    Route::post('/check-coupon' , [CartController::class , 'checkCoupon'])->name('users_profile.cart.checkcoupon')->middleware('verified');
    Route::get('/checkout' , [CartController::class , 'checkout'])->name('users_profile.orders.checkout')->middleware('verified');

    Route::get('/orders' , [CartController::class , 'usersOrder'])->name('users_profile.orders')->middleware('verified');
    Route::get('/order-items' , [CartController::class , 'usersOrderItems'])->name('users_profile.orderItems')->middleware('verified');
    Route::get('/order-items/{course}/movie' , [CartController::class , 'usersOrderItemsMovie'])->name('users_profile.orderItemsMovie')->middleware('verified');
    Route::post('/order-items/{movie}/add-view' , [CartController::class , 'add_view'])->name('users_profile.orderItemsMovie.add_view')->middleware('verified');
    Route::resource('order-items/exam', ScoreController::class)->middleware('verified');
    Route::get('/order-items/certificate',[ScoreController::class , 'index_certificate'])->name('certificate.index')->middleware('verified');
    Route::get('/order-items/{score}/certificate-show',[ScoreController::class , 'show_certificate'])->name('certificate.show')->middleware('verified');

    Route::get('/addresses' , [AddressController::class , 'index'])->name('users_profile.addresse')->middleware('verified');
    Route::post('/addresses', [AddressController::class, 'store'])->name('users_profile.addresse.store')->middleware('verified');
    Route::put('/addresses/{address}', [AddressController::class, 'update'])->name('users_profile.addresse.update')->middleware('verified');
    Route::get('/get-state-cities-list', [AddressController::class, 'getStateCitiesList'])->middleware('verified');

});

Route::get('/',[HomeController::class , 'index'])->name('index');
Route::get('/courses/all' , [HomeCategoryController::class , 'all_courses'])->name('home.courses.all-courses');
Route::get('/categories/{category:slug}' , [HomeCategoryController::class , 'show'])->name('home.categories.show');
Route::get('/courses/{course:slug}' , [HomeCourseController::class , 'show'])->name('home.courses.show');
Route::post('/comment/{course}' , [HomeCommentController::class , 'store'])->name('home.comments.store');

Route::get('/add-to-favorite-list/{course}' , [FavoritelistController::class , 'add'])->name('home.favoritelist.add');
Route::get('/remove-from-favorite-list/{course}' , [FavoritelistController::class , 'remove'])->name('home.favoritelist.remove');

Route::get('/add-to-compare-list/{course}' , [CompareController::class , 'add'])->name('home.compare.add');
Route::get('/remove-to-compare-list/{course}' , [CompareController::class , 'remove'])->name('home.compare.remove');

Route::post('/add-to-cart' , [CartController::class , 'add'])->name('home.cart.add');

Route::post('/payment' , [PaymentController::class , 'payment'])->name('home.payment');
Route::get('/payment-verify/{gatewayName}' , [PaymentController::class , 'paymentVerify'])->name('home.payment_verify');

Route::get('/about-us' , [HomeController::class , 'aboutUs'])->name('home.about-us');
Route::get('/contact-us' , [HomeController::class , 'contactUs'])->name('home.contact-us');
Route::post('/contact-us-form' , [HomeController::class , 'contactUsForm'])->name('home.contact-us.form');
Route::get('/banner-show' , [HomeController::class , 'banner_show'])->name('home.banner-show');

Route::get('/login/{provider}' , [AuthController::class , 'redirectToProvider'])->name('provider.login');
Route::get('/login/{provider}/callback' , [AuthController::class , 'handleProviderCallback']);

// OTP
Route::any('/login-mobile' , [OTPAuthController::class , 'login'])->name('login-mobile');
Route::post('/check-otp' , [OTPAuthController::class , 'checkOtp']);
Route::post('/resend-otp' , [OTPAuthController::class , 'resendOtp']);

Route::get('/logout' , function(){
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/sitemap' , [SitemapController::class , 'index'])->name('home.sitemap.index');
Route::get('/sitemap-tags' , [SitemapController::class , 'sitemapTags'])->name('home.sitemap.tags');
Route::get('/sitemap-courses' , [SitemapController::class , 'sitemapCourses'])->name('home.sitemap.courses');
Route::get('/sitemap-courses-movies' , [SitemapController::class , 'sitemapCoursesMovies'])->name('home.sitemap.courses.movies');
