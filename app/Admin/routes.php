<?php

use Illuminate\Routing\Router;
// use App\Admin\Controllers\Professions\ProfessionsController;

Admin::registerAuthRoutes();

Route::group([
	'prefix' => config('admin.route.prefix'),
	'namespace' => config('admin.route.namespace'),
	'middleware' => config('admin.route.middleware'),
], function (Router $router) {

	$router->get('/', 'HomeController@index');
	$router->resource('professions', \Professions\ProfessionsController::class);
	//users
	$router->resource('customers', \Customers\CustomersController::class);
	$router->resource('users/hosts', \Customers\HostsUsersController::class);
	$router->resource('badges', \Badges\BadgesController::class);
	$router->resource('users/packages', \Customers\PackagesController::class);
	$router->resource('users/eas_price', \Customers\EasPriceController::class);

	// events
	$router->resource('event/event_details', 'Event\EventDetailsController');
        $router->post('event/event_details', 'Event\EventDetailsController@delete');
	$router->resource('event/require-data', "Event\RequireDataController");
	$router->resource('event/category', "Event\CategoryController");
	$router->resource('event/address-type', "Event\AddressTypeController");
	$router->resource('event/main-type', "Event\MainTypeController");
	$router->resource('event/venue', "Event\VenueController");
	$router->resource('event/location', "Event\LocationController");
	$router->get('event/canceled_ticket/{id}', 'Event\CanceledTicketController@index')->name('admin.canceled_ticket');
	$router->get('event/view_booking/{id}', 'Event\CanceledTicketController@indexBooking')->name('admin.booking');
	// added
	$router->resource('added/added_sponsor', 'Added\AddedSponsorController');
	$router->resource('added/added_company', 'Added\AddedCompanyController');
	$router->resource('added/added_professional', 'Added\AddedProfessionalController');
	$router->resource('added/added_venue', 'Added\AddedVenueController');
	// world
	$router->resource('world/country', "World\CountryController");
	$router->resource('world/city', "World\CityController");
	//social media
	$router->resource('social_media', "SocialMedia\SocialMediaController");
	//notifications
	$router->resource('notifications', "Notifications\SendNotificationController");
	//pages 
	$router->resource('pages/all', "Pages\PagesController");
	$router->resource('pages/faqs', "Pages\FaqsController");
	//settings 
	$router->resource('setting/currency', "Settings\CurrencyController");
	$router->resource('setting/setting', "Settings\SettingController");

	//sales 
	$router->resource('sales/packages', "Sales\PackageTransactionController");
	$router->resource('sales/events', "Sales\EventBookingController");

	




});
