<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['prefix' => 'v1/website'], function ($api) {

        $api->get('/users',                             'App\Http\Controllers\Api\Customer\UserController@show');
        $api->post('/login',                            'App\Http\Controllers\Api\Customer\UserController@login');
        $api->post('/register',                         'App\Http\Controllers\Api\Customer\UserController@register');
        
    //Cart And Product Section

        $api->post('/check_avaliable_time',             'App\Http\Controllers\Api\Checkout\CheckoutController@checkAvailableTime');
        $api->post('/check_avaliable_area',             'App\Http\Controllers\Api\Checkout\CheckoutController@checkAvailableArea');
    });

});

$api->version('v1', ['middleware' => 'auth:api'], function ($api) {
    $api->group(['prefix' => 'v1/customer'], function ($api) {
        $api->get('/profile',                           'App\Http\Controllers\Api\Customer\UserController@profile');
        $api->get('/loyalty_points_posts',              'App\Http\Controllers\Api\Customer\UserController@loyaltyPoints');
        $api->post('/update_profile',                   'App\Http\Controllers\Api\Customer\UserController@updateProfile');
        $api->post('/update_password',                  'App\Http\Controllers\Api\Customer\UserController@updatePassword');

        $api->get('/addresses',                         'App\Http\Controllers\Api\Customer\UserAddressController@addresses');
        $api->delete('/delete_address/{address_id}',    'App\Http\Controllers\Api\Customer\UserAddressController@deleteAddress');
        $api->post('/create_address',                   'App\Http\Controllers\Api\Customer\UserAddressController@saveAddress');
        $api->put('/update_address/{address_id}',       'App\Http\Controllers\Api\Customer\UserAddressController@updateAddress');
        $api->post('/addReview',                        'App\Http\Controllers\Api\Products\ProductsController@addReview');
        $api->post('/add_to_cart',                      'App\Http\Controllers\Api\Checkout\CheckoutController@addToCart');

    });

});


