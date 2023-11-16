<?php

use Illuminate\Support\Facades\Route;
//frontend
use App\Http\Controllers\frontend\SiteController;
use App\Http\Controllers\frontend\FrontendController;
use App\Http\Controllers\frontend\CartController;

//backend
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\TopicController;
use App\Http\Controllers\backend\PageController;
use App\Http\Controllers\backend\CustomerController;
use App\Http\Controllers\backend\ContactController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\MenuController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\orderdetailController;



//trang chu
Route::get('/',[SiteController::class,'index'])->name('site.index');
Route::get('/sanpham', [SiteController::class,'product'])->name('site.product');
Route::get('dangnhap',[FrontendController::class,'login'])->name('frontend.login');
Route::get('lienhe',[FrontendController::class,'contact'])->name('frontend.contact');
Route::get('gioithieu',[FrontendController::class,'about'])->name('frontend.about');
//product
Route::get('/product/{product}', [SiteController::class,'productdetail'])->name('product.detail');

//brand
Route::get('/brands/{slug}', [FrontendController::class, 'show']);
Route::get('/brands/{slug}', [FrontendController::class, 'show'])->name('brands.products');
Route::get('/brands', [FrontendController::class, 'brand'])->name('frontend.brands');
Route::get('/brand/{id}/products', [FrontendController::class, 'ProductsBrand'])->name('products.brands');

//Cart
Route::get('/carts', [CartController::class, 'index'])->name('carts');
Route::post('/carts', [CartController::class, 'index']);
Route::get('show', [CartController::class, 'show'])->name('show');
Route::post('update', [CartController::class, 'update'])->name('update');
Route::get('carts/delete/{id}', [CartController::class, 'remove'])->name('remove');
Route::post('addcarts', [CartController::class, 'addCart'])->name('addCart');
Route::post('/cart/add', [App\Http\Controllers\frontend\CartController::class, 'addItem'])->name('cart.add');
//Post
Route::get('/posts', [FrontendController::class, 'showPosts'])->name('frontend.posts');
Route::get('/posts/{id}', [FrontendController::class, 'showdetail'])->name('frontend.postdetail');
//topic
Route::get('/topics', [FrontendController::class, 'index'])->name('frontend.topic');
//contact
Route::post('/contact/store', [FrontendController::class, 'storeContact'])->name('frontend.contact.store');


//category
Route::get('/category', [FrontendController::class, 'category'])->name('frontend.category');
Route::get('/category/{id}/products', [FrontendController::class, 'ProductsCategory'])->name('products.category');


Route::get('admin/login', [AuthController::class, 'getlogin'])->name('admin.getlogin');
Route::post('admin/login', [AuthController::class, 'postlogin'])->name('admin.postlogin');
Route::get('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
Route::prefix('admin')->middleware('login')->group(function () {
  // Route::prefix('admin')->group(function () {    
  Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    //product
    Route::get('product/status/{product}',[ProductController::class,'status'])->name('product.status');
    Route::get('product/delete/{product}',[ProductController::class,'delete'])->name('product.delete');
    Route::get('product/restore/{product}',[ProductController::class,'restore'])->name('product.restore');
    Route::get('product/trash',[ProductController::class,'trash'])->name('product.trash');
    Route::resource('product', ProductController::class);    
    //endproduct
    //category
    Route::get('category/status/{category}',[CategoryController::class,'status'])->name('category.status');
    Route::get('category/delete/{category}',[CategoryController::class,'delete'])->name('category.delete');
    Route::get('restore/{category}',[CategoryController::class,'restore'])->name('category.restore');
    Route::get('category/trash',[CategoryController::class,'trash'])->name('category.trash');
    Route::resource('category', CategoryController::class);    
    //endcategory
    //brand
    Route::get('brand/status/{brand}',[BrandController::class,'status'])->name('brand.status');
    Route::get('brand/delete/{brand}',[BrandController::class,'delete'])->name('brand.delete');
    Route::get('brand/restore/{brand}',[BrandController::class,'restore'])->name('brand.restore');
    Route::get('brand/trash',[BrandController::class,'trash'])->name('brand.trash');
    Route::resource('brand', BrandController::class);    
    //endbrand
    //post
    Route::get('post/status/{post}',[PostController::class,'status'])->name('post.status');
    Route::get('post/delete/{post}',[PostController::class,'delete'])->name('post.delete');
    Route::get('post/restore/{post}',[PostController::class,'restore'])->name('post.restore');
    Route::get('post/trash',[PostController::class,'trash'])->name('post.trash');
    Route::resource('post', PostController::class);    
    //endpost
    //topic
    Route::get('topic/status/{topic}',[TopicController::class,'status'])->name('topic.status');
    Route::get('topic/delete/{topic}',[TopicController::class,'delete'])->name('topic.delete');
    Route::get('topic/restore/{topic}',[TopicController::class,'restore'])->name('topic.restore');
    Route::get('topic/trash',[TopicController::class,'trash'])->name('topic.trash');
    Route::resource('topic', TopicController::class);    
    //endtopic
    //page
    Route::get('page/status/{page}',[PageController::class,'status'])->name('page.status');
    Route::get('page/delete/{page}',[PageController::class,'delete'])->name('page.delete');
    Route::get('page/restore/{page}',[PageController::class,'restore'])->name('page.restore');
    Route::get('page/trash',[PageController::class,'trash'])->name('page.trash');
    Route::resource('page', PageController::class);    
    //endpage
    //customer
    Route::get('customer/status/{customer}',[CustomerController::class,'status'])->name('customer.status');
    Route::get('customer/delete/{customer}',[CustomerController::class,'delete'])->name('customer.delete');
    Route::get('customer/restore/{customer}',[CustomerController::class,'restore'])->name('customer.restore');
    Route::get('customer/trash',[CustomerController::class,'trash'])->name('customer.trash');
    Route::resource('customer', CustomerController::class);    
    //endcustomer
    //order
    Route::get('order/status/{order}',[orderController::class,'status'])->name('order.status');
    Route::get('order/delete/{order}',[orderController::class,'delete'])->name('order.delete');
    Route::get('order/restore/{order}',[orderController::class,'restore'])->name('order.restore');
    Route::get('order/trash',[orderController::class,'trash'])->name('order.trash');
    Route::resource('order', orderController::class);    
    //endorder
    //contact
    Route::get('contact/status/{contact}',[ContactController::class,'status'])->name('contact.status');
    Route::get('contact/delete/{contact}',[ContactController::class,'delete'])->name('contact.delete');
    Route::get('contact/restore/{contact}',[ContactController::class,'restore'])->name('contact.restore');
    Route::get('contact/trash',[ContactController::class,'trash'])->name('contact.trash');
    Route::resource('contact', ContactController::class);  
     
     
    //endcontact
    //menu
    Route::get('menu/status/{menu}',[MenuController::class,'status'])->name('menu.status');
    Route::get('menu/delete/{menu}',[MenuController::class,'delete'])->name('menu.delete');
    Route::get('menu/restore/{menu}',[MenuController::class,'restore'])->name('menu.restore');
    Route::get('menu/trash',[MenuController::class,'trash'])->name('menu.trash');
    Route::resource('menu', MenuController::class);    
    //endmenu
    //slider
    Route::get('slider/status/{slider}',[SliderController::class,'status'])->name('slider.status');
    Route::get('slider/delete/{slider}',[SliderController::class,'delete'])->name('slider.delete');
    Route::get('slider/restore/{slider}',[SliderController::class,'restore'])->name('slider.restore');
    Route::get('slider/trash',[SliderController::class,'trash'])->name('slider.trash');
    Route::resource('slider', SliderController::class);    
    //endslider
     ////user
     Route::get('user/status/{user}',[UserController::class,'status'])->name('user.status');
     Route::get('user/delete/{user}',[UserController::class,'delete'])->name('user.delete');
     Route::get('user/show/{user}', [UserController::class, 'show'])->name('user.show');
     Route::get('user/restore/{user}',[UserController::class,'restore'])->name('user.restore');
     Route::get('user/trash',[UserController::class,'trash'])->name('user.trash');
     Route::resource('user', UserController::class);    
     //   
    Route::resource('orderdetail', OrderdetailController::class); 
    //page
    Route::get('page/status/{page}',[PageController::class,'status'])->name('page.status');
    Route::get('page/delete/{page}',[PageController::class,'delete'])->name('page.delete');
    Route::get('page/restore/{page}',[PageController::class,'restore'])->name('page.restore');
    Route::get('page/trash',[PageController::class,'trash'])->name('page.trash');
    Route::resource('page', PageController::class);    



});

Route::get("{slug}",[SiteController::class,'index'])->name('site.slug');
Route::post('/site/postlogin', [AuthController::class,'postLogin'])->name('site.postlogin');
//trang nguoi dung
