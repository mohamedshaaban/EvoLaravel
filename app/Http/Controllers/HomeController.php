<?php

namespace App\Http\Controllers;

use App\Models\AddedProfessional;
use App\Models\Category;
use App\Models\City;
use App\Models\customers;
use App\Models\Event;
use App\Models\EventInvitation;
use App\Models\EventReviews;
use App\Models\EventsUsers;
use App\Models\MainType;
use App\Models\Notifications;
use App\Models\SendNotification;
use App\Models\UserContacts;
use App\Models\UserFavoriteHosts;
use App\Models\UserNotified;
use App\Models\UserReports;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\UserProfessions;
use App\Models\HostsUsers;
use App\Models\UserSocialMedia;
// use Symfony\Component\DomCrawler\Image;
use Validator;


use App\Models\Professions;
use App\Models\Country;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (!session()->get('country')) {

//                $view->with('selectedcountry', Country::where('code', 'KWD')->first());
                session()->put('country', Country::where('code', 'KWD')->first(['id'])->id);
                session()->save();
            }
        $mytime = Carbon::today()->format('Y-m-d');


        return view('home')
            ->with('titlePage', 'Events')
            ->with('categories', Category::with('parent')->where('category_id', 0)->orderBy('category_id')->get())
            ->with('types', MainType::all())
            ->with('countries' , Country::where('status',1)->get())
            ->with('locations',Event::whereIn('address_city', City::where('country_id',isset(auth()->user()->country_id)? :116)->get(['id']) )->distinct()->get(['location_name_en']))
            ->with('age_from',Event::distinct()->orderBy('age_from','asc')->get(['age_from']))
            ->with('age_to',Event::distinct()->orderBy('age_from','asc')->get(['age_to']))
            ->with('event_sliders',Event::where('main',1)->where('private_event',0)->whereIn('address_city',City::where('country_id', $request->session()->get('country'))->get(['id']))->Where( 'date_from', '>', $mytime )->orwhere('date_to', '>', $mytime)->get())
            ->with('events_main',Event::where('date_from','<',$mytime)->where('private_event',0)->where('main',1)->whereIn('address_city',City::where('country_id', $request->session()->get('country'))->get(['id']))->Where( 'date_from', '>', $mytime )->orwhere('date_to', '>', $mytime)->get())
            ->with('happening_events',Event::where('date_from','<',$mytime)->where('private_event',0)->where('date_to','>',$mytime)->whereIn('address_city',City::where('country_id', $request->session()->get('country'))->get(['id']))->where('disable_from_home',0)->Where( 'date_from', '>', $mytime )->orwhere('date_to', '>', $mytime)->orderByRaw('updated_at - created_at DESC')->limit(6)->get())
            ->with('popular_events',Event::whereIn('id',EventsUsers::get(['event_id']))->where('private_event',0)->where('date_to','>',$mytime)->whereIn('address_city',City::where('country_id', $request->session()->get('country'))->get(['id']))->Where( 'date_from', '>', $mytime )->orwhere('date_to', '>', $mytime)->get())
            ->with('popular_hosts',HostsUsers::whereIn('id',Event::get(['host_id']))->whereIn('user_id',User::where('country_id',$request->session()->get('country'))->get(['id']))->get())
            ->with('sponsored_hosts',HostsUsers::where('sponsored',1)->whereIn('user_id',User::where('country_id',$request->session()->get('country'))->get(['id']))->get())
            ->with('professions',HostsUsers::whereIn('user_id',User::where('country_id',$request->session()->get('country'))->get(['id']))->orderBy('created_at', 'desc')->limit(6)->get())
            ->with('event_categories',Event::where('featured',1)->distinct()->get(['category_id']));
    }
    public function get_sub_categories(Request $request)
    {
        $sub_cateogries = Category::whereIn('category_id',$request->category_id)->get(['id','name_en','name_ar']);
        return $sub_cateogries;
    }
    public function get_main_types(Request $request)
    {
        $sub_cateogries = MainType::where('event_type',$request->type)->get(['id','name_en','name_ar']);
        return $sub_cateogries;
    }
    //

    public function report_user(Request $request)
    {
        $user = Auth::user();

        return view('host.balance',['user'=>$user]);
    }
    public function send_problem(Request $request)
    {
        $user = Auth::user();
        $user_report = new UserReports();
        $user_report->title = $request->title ;
        $user_report->problem = $request->problem ;
        $user_report->reported_id = $request->reported_id ;
        if($user) {
            $user_report->reporter_id = $user->id;
        }
        if ($user_report->save() ) {

            Session::flash('message', 'Problem sent successfully');
        } else {

            Session::flash('alert', 'Problem not updated ');
        }
        $host = HostsUsers::where('user_id', $request->reported_id)->first();
        return redirect(route('host_profile',['host_id'=>$host->id]));
    }
    public function send_problem_cutomer(Request $request)
    {
        $user = Auth::user();
        $user_report = new UserReports();
        $user_report->title = $request->title ;
        $user_report->problem = $request->problem ;
        $user_report->reported_id = $request->reported_id ;
        $user_report->reporter_id = $user->id;
        if ($user_report->save() ) {

            Session::flash('message', 'Problem sent successfully');
        } else {

            Session::flash('alert', 'Problem not updated ');
        }
        $host = customers::where('user_id', $request->reported_id)->first();
        return redirect(route('user_profile',['user_id'=>$host->user_id]));
    }
    public function add_contact(Request $request)
    {
        $user = Auth::user();
        $contact = User::where('id', $request->user_id )->first();
        $usercontact = new UserContacts();
        $usercontact->user_id = $user->id;
        $usercontact->owner_id = $contact->id;
        $usercontact->name = $contact->name;
        $usercontact->image = $contact->avatar;
//        $usercontact->phone = $user->id;
        $usercontact->save();
        return ;
    }
    public function add_favorite(Request $request)
    {
        $user = Auth::user();
        $UserFavoriteHosts = new UserFavoriteHosts();
        $UserFavoriteHosts->user_id = $user->id;
        $UserFavoriteHosts->host_id = $request->host_id;

        $UserFavoriteHosts->save();
        return ;
    }
    public function notifiy_host(Request $request)
    {
        $user = Auth::user();
        $usernotif = UserNotified::where('user_id',$user->id)->where('host_id',$request->host_id)->first();
        if($usernotif)
        {
            $usernotif->delete();
        }
        else
        {
            $usernotified = new UserNotified();
            $usernotified->user_id = $user->id;
            $usernotified->host_id = $request->host_id;
            $usernotified->save();
        }
return ;
    }
    public function getSubCategory(Request $request)
    {
        
        $categories =  Category::where(  'category_id', $request->id )->get();
        $category_array = array();
        foreach ($categories as $category) {
            $category_array[$category->id] = $category->name();
        }
        return response()->json(
            $category_array
        );
    }
    public function get_cities(Request $request)
    {
        $cities = City::where(  'country_id', $request->id )->get();
        $city_array = array();
        foreach ($cities as $city) {
            $city_array[$city->id] = $city->name();
        }
        return response()->json(
            $city_array
        );        
    }
}
