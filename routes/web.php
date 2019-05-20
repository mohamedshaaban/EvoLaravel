<?php

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




Route::post('/getSubCategory', 'HomeController@getSubCategory')->name('getSubCategory');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
Route::post('/get_sub_categories', 'HomeController@get_sub_categories')->name('get_sub_categories');
Route::post('/get_cities', 'HomeController@get_cities')->name('get_cities');
Route::post('/get_main_types', 'HomeController@get_main_types')->name('get_main_types');

Route::post('/add_contact', 'HomeController@add_contact')->name('add_contact');
Route::post('/add_favorite', 'HomeController@add_favorite')->name('add_favorite');
Route::post('/notifiy_host', 'HomeController@notifiy_host')->name('notifiy_host');
Route::get('/hosts', 'Host\HostsController@list_hosts')->name('hosts');
Route::get('/events/{category_id}', 'Events\EventsController@list_events_category')->name('eventscategory');
Route::post('/hosts', 'Host\HostsController@list_hosts')->name('filter_hosts');
Route::get('/thisweek', 'Events\EventsController@thisweek')->name('thisweek');
Route::get('/thisweekend', 'Events\EventsController@thisweekend')->name('thisweekend');
Route::get('/calendar', 'Events\EventsController@calendar')->name('calendar');
Auth::routes();
Route::get('/report/user/{user_id}', 'HomeController@report_user')->name('report_user');
Route::post('/send_problem', 'HomeController@send_problem')->name('send_problem');
Route::post('/send_problem_customer', 'HomeController@send_problem_cutomer')->name('send_problem_cutomer');
// hostes routes
Route::get('/host/register', 'Host\HostRegisterController@index')->name('host_register');
Route::get('/host-profile/{host_name}', 'Host\HostsController@host_profile')->name('host_profile');
Route::get('/host-profile/{user_id}', 'Host\HostsController@host_event_profile')->name('host_event_profile');
Route::get('/user-profile/{user_id}', 'Customer\CustomerController@user_profile')->name('user_profile');
Route::get('/host-media/{host_id}', 'Host\HostsController@host_media')->name('host_media');
Route::get('/host-badges/{host_id}', 'Host\HostsController@host_badges')->name('host_badges');
Route::get('/host/items/{host_id}', 'Host\HostsController@hosted_items')->name('hosted_items');
Route::post('/host/items/{host_id}', 'Host\HostsController@filter_host_calendar')->name('filter_host_calendar');
Route::get('/host/rating/{host_id}', 'Host\HostsController@host_rating')->name('host_rating');
Route::post('/host/review_host', 'Host\HostsController@review_host')->name('review_host');
Route::post('/host/register', 'Host\HostRegisterController@store')->name('host_register');
Route::post('/host/editprofile', 'Host\HostRegisterController@editprofile')->name('host_edit_profile');
Route::post('/host/register/validation', 'Host\HostRegisterController@validation')->name('host_register.validation');
Route::post('/host/media/delete', 'Host\HostsController@deletemedia')->name('host.deleteimage');
Route::post('/host/social/delete', 'Host\HostsController@deletesocial')->name('host.deletesocial');
Route::post('/host/certificate/delete', 'Host\HostsController@deletecertificate')->name('host.deletecertificate');

Route::middleware(['auth', 'AuthHost'])->prefix('host')->group(
    function () {
        Route::post('/filter-my-calendar', 'Customer\CustomerController@filter_my_calendar')->name('host.filter__my_calendar');
        Route::post('/change_password', 'Host\HostsController@change_password')->name('host.change_password');
        Route::post('/change_profile_picture', 'Host\HostsController@change_profile_picture')->name('host.change_profile_picture');
        Route::post('/update_host_profile', 'Host\HostsController@update_host_profile')->name('host.update_host_profile');
        Route::post('/add_terms_privacy', 'Host\HostsController@add_terms_privacy')->name('host.add_terms_privacy');
        Route::get('/my_account', 'Host\HostsController@account_info')->name('host.my_account');
        Route::get('/my_profile', 'Host\HostsController@account_profile')->name('host.my_profile');
        Route::get('/my_professions', 'Host\HostsController@my_professions')->name('host.my_professions');
        Route::get('/my_media', 'Host\HostsController@account_media')->name('host.my_media');
        Route::get('/my_privacy', 'Host\HostsController@my_privacy')->name('host.my_privacy');
        Route::get('/my_terms', 'Host\HostsController@my_terms')->name('host.my_terms');
        Route::post('/upload_media', 'Host\HostsController@upload_media')->name('host.upload_media');
        Route::get('/my_ratings', 'Host\HostsController@my_ratings')->name('host.my_ratings');
        Route::post('/select_plan', 'Packages\PackagesController@list_plans')->name('host.select_plan');
        Route::post('/add_new_eas', 'Packages\PackagesController@add_new_eas')->name('host.add_new_eas');
        Route::post('/add_new_package', 'Packages\PackagesController@add_new_package')->name('host.add_new_package');

        Route::get('/my_contacts', 'Host\HostsController@account_contacts')->name('host.my_contacts');
        Route::get('/my_badges', 'Host\HostsController@account_badges')->name('host.my_badges');
        // Route::get('/my-badges', 'Host\HostsController@account_badges')->name('host.my_badges');
        Route::get('/my_fav-hosts', 'Host\HostsController@account_favorite_hosts')->name('host.my_favorite_hosts');
        Route::get('/my_calendar', 'Host\HostsController@account_calendar')->name('host.my_calendar');
        
        Route::get('/my_history/hosted', 'Host\HostsController@my_history_hosted')->name('host.my_history_hosted');
        Route::get('/my_history/booked', 'Host\HostsController@my_history_booked')->name('host.my_history_booked');
        Route::get('/my-bookings/{id}/hosted', 'Customer\CustomerController@history_details_hosted')->name('host.my_booking_detail_hosted');
        Route::get('/my-bookings/{id}/booked', 'Customer\CustomerController@history_details_booked')->name('host.my_booking_detail_booked');
        Route::get('/my-orders/{event_id}', 'Customer\CustomerController@orders')->name('host.my_orders');
        Route::get('/my-event-attendee/{event_id}', 'Customer\CustomerController@attendees')->name('host.my_event_attendee');
        Route::get('/my-event-tickets/{event_id}', 'Customer\CustomerController@my_tickets')->name('host.my_event_ticket');
	    Route::post('/set-attendee', 'Customer\CustomerController@set_attendees')->name('host.set_attendee');
	    Route::post('/cancel-ticket', 'Customer\CustomerController@cancel_ticket')->name('host.cancel');
	    Route::get('/my_invites', 'Host\HostsController@account_invites')->name('host.my_invites');
        Route::get('/my_invitations', 'Host\HostsController@account_invitations')->name('host.my_invitations');
        Route::get('/my_balance', 'Host\HostsController@account_balance')->name('host.account_balance');
        Route::post('/edit_username', 'Host\HostsController@edit_username')->name('host.edit_user');
// Event creating 16-10-2018
        // Event
        Route::get('/event/create', 'Event\CreateController@index')->name('event.create');
        Route::post('/event/save', 'Event\CreateController@save')->name('event.save');
        Route::post('/event/news', 'Event\CreateController@news')->name('event.news');
        Route::get('/event/livePreview1', 'Event\CreateController@livePreview1')->name('event.live_preview1');
        Route::get('/event/livePreview2', 'Event\CreateController@livePreview2')->name('event.live_preview2');
        Route::post('/event/upload', 'Event\CreateController@upload_files')->name('event.upload');
        Route::post('/event/professional', 'Event\CreateController@professional')->name('event.professional');
        Route::post('/event/professional/add', 'Event\CreateController@add_professional')->name('event.professional.add');
        Route::post('/event/company', 'Event\CreateController@company')->name('event.company');
        Route::post('/event/company/add', 'Event\CreateController@add_company')->name('event.company.add');
        Route::post('/event/sponsor', 'Event\CreateController@sponsor')->name('event.sponsor');
        Route::post('/event/sponsor/add', 'Event\CreateController@add_sponsor')->name('event.sponsor.add');
//End of Event creating

    }
);

// customer routes
Route::get('/customer/register', 'Customer\CustomerRegisterController@index')->name('customer_register');
Route::post('/customer/register', 'Customer\CustomerRegisterController@store')->name('customer_register');
Route::middleware('auth')->group(
    function () {
        Route::prefix('customer')->group(function () {
            Route::post('/change_password', 'Customer\CustomerController@change_password')->name('change_password');
            Route::post('/change_notification_setting', 'Customer\CustomerController@change_notification_setting')->name('change_notification_setting');
            Route::get('/my-account', 'Customer\CustomerController@account_info')->name('my_account');
            Route::get('/my-profile', 'Customer\CustomerController@account_profile')->name('my_profile');
            Route::post('/update_customer_profile', 'Customer\CustomerController@update_customer_profile')->name('customer.update_customer_profile');
            Route::get('/my-contacts', 'Customer\CustomerController@account_contacts')->name('my_contacts');
            Route::get('/my-badges', 'Customer\CustomerController@account_badges')->name('my_badges');
            Route::get('/my-badges', 'Customer\CustomerController@account_badges')->name('my_badges');
            Route::get('/my-fav-hosts', 'Customer\CustomerController@account_favorite_hosts')->name('my_favorite_hosts');
            Route::get('/my-calendar', 'Customer\CustomerController@account_calendar')->name('my_calendar');
            Route::post('/filter-my-calendar', 'Customer\CustomerController@filter_my_calendar')->name('filter__my_calendar');
            Route::get('/my-bookings', 'Customer\CustomerController@account_bookings')->name('my_bookings');
            Route::get('/my-invites', 'Customer\CustomerController@account_invites')->name('my_invites');
            Route::get('/my-invitations', 'Customer\CustomerController@account_invitations')->name('my_invitations');
            Route::get('/my-bookings/{id}', 'Customer\CustomerController@history_details')->name('customer.my_booking_detail');
            Route::get('/my-orders/{event_id}', 'Customer\CustomerController@orders')->name('customer.my_orders');
            Route::get('/my-event-attendee/{event_id}', 'Customer\CustomerController@attendees')->name('customer.my_event_attendee');
            Route::post('/set-attendee', 'Customer\CustomerController@set_attendees')->name('customer.set_attendee');

// X Editable
            Route::post('/edit_username', 'Customer\CustomerController@edit_username')->name('edit_user');
        });
//Event booking
        Route::get('/events/booking/{id}', 'Events\EventsController@booking')->name('event.booking');
        Route::post('/events/place_order/{id}', 'Events\EventsController@placeOrder')->name('event.place_order');
        Route::post('/events/checkout/{id}', 'Events\EventsController@checkout')->name('event.checkout');
        Route::get('/events/checkout/{id}/thankyou', 'Events\EventsController@thankYou')->name('event.thank_you');

    }
);

Route::get('/setting/city/{country}', 'SettingsController@city')->name('settings.city');
Route::post('/setting/user', 'SettingsController@user')->name('settings.user');



//Events
Route::get('/events', 'Events\EventsController@list_events')->name('events');
Route::post('/events', 'Events\EventsController@search_events')->name('search_filter');
Route::get('/event/{event_id}', 'Events\EventsController@event_details')->name('event_details');
Route::get('/event/host/{host_id}', 'Events\EventsController@host_events')->name('host_events');
Route::get('/event/type/{type_id}', 'Events\EventsController@type_events')->name('type_events');
Route::post('/review_event', 'Events\EventsController@review_event')->name('review_event');
Route::post('/report_event', 'Events\EventsController@report_event')->name('report_event');




// switch language
Route::get('/switch_lang/{locale}', function ($locale = '') {
    session(['locale' => $locale]);
    App::setLocale($locale);

    return redirect()->back();
})->name('switch_lang');
// switch country
//Route::get('/switchcountry/{country}', function ($country) {
////dd($country);
//    session(['country' => $country]);
//
//    return redirect()->back();
//})->name('switchcountry');
Route::group(['prefix' => '{country}', 'middleware' => 'country'], function () {
    Route::get('/country', function ($country, Illuminate\Http\Request $request) {
        return $request->session()->get('country');
    })->name('change_country');
});

Route::group(['prefix' => '{currency}', 'middleware' => 'currency'], function () {
    Route::get('/currency', function ($currency, Illuminate\Http\Request $request) {
        return $request->session()->get('currency');
    })->name('change_currency');
});

//Route::get('/switchcountry','')->name('switchcountry');
// pages
Route::get('/pages/{slug}', 'Pages\PagesController@getPage')->name('pages');
Route::post('/pages/contact_us', 'Pages\PagesController@storeContactUs')->name('store_contact_us');



//admin event details
Route::get('/admin/event_booking/{event_id}', 'Admin\EventbookingDetailsController@booking')->middleware(config('admin.route.middleware'));
Route::get('/admin/event_attendee/{event_id}', 'Admin\EventbookingDetailsController@attendees')->middleware(config('admin.route.middleware'))->name('admin.booking_attendees');
