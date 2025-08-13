<?php

use Illuminate\Routing\Router;


use App\Admin\Controllers\DuoController;



Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    $router->get('duo/available-second-profile', [DuoController::class, 'availableSecondProfile']);

    $router->resource('link-groups', Link\LinkGroupController::class);
    $router->resource('link-managers', Link\LinkManagerController::class);

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('blogs', BlogController::class);
    $router->resource('homepage', HomePageController::class);
    $router->resource('aboutpage', AboutController::class);
    $router->resource('termpage', TermConditionController::class);
    $router->resource('privecypage', PrivicyController::class);
    $router->resource('setting', SettingController::class);
    

     $router->resource('rota', RotaController::class);

     $router->resource('locations', LocationController::class);
     $router->resource('profile', ProfileController::class);
     $router->resource('duopage', DuoController::class);


      $router->resource('fav', FaviroutController::class);
     $router->resource('booking', BookingController::class);
     $router->resource('casting', CastingController::class);


    $router->resource('bookformdata', EnquireController::class);

    $router->resource('pages', PageManagerController::class);

    $router->resource('faq-types', Faq\TypeController::class);

    $router->resource('faqs', Faq\FaqController::class);


    $router->resource('page-sections', PageSectionController::class);

    $router->resource('categories', CategoryController::class);

    $router->resource('category-sections', CategorySectionController::class);

    $router->resource('contact-form', ContactFormController::class);
  
   
    
    $router->resource('menu', HeaderController::class);
    
});
