<?php

namespace App\Http\Controllers\Customer;

use App\Models\Attendee;
use App\Models\Booking;
use App\Models\Category;
use App\Models\customers;
use App\Models\Event;
use App\Models\EventInvitation;
use App\Models\EventsUsers;
use App\Models\MainType;
use App\Models\UserFavoriteHosts;
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
use App\Models\UserStatus;

class CustomerController extends Controller
{

    public function account_info(Request $request)
    {
        $user = Auth::user();
        $countries = Country::all();
        return view('customer.account', ['user' => $user ,'countries'=>$countries]);
    }

    public function account_profile(Request $request)
    {
        $user = Auth::user();
        $countries = Country::all();
        return view('customer.profile', ['user' => User::where('id',$user->id)->first() ,'countries'=>$countries]);
    }

    public function account_contacts(Request $request)
    {
        $user = Auth::user();
        $countries = Country::all();
        return view('customer.contacts', ['user' => User::where('id',$user->id)->first() ,'countries'=>$countries]);
    }
    public function account_badges(Request $request)
    {
        $user = Auth::user();
        $countries = Country::all();
        return view('customer.badges', ['user' => User::where('id',$user->id)->first() ,'countries'=>$countries]);
    }
    public function account_favorite_hosts(Request $request)
    {
        $user = Auth::user();
        $countries = Country::all();

        $favorites =HostsUsers::whereIn('id',UserFavoriteHosts::where('user_id',$user->id)->get(['host_id']))->get() ;
        return view('customer.favorite_hosts', ['hosts' => $favorites ,'countries'=>$countries]);
    }
    public function account_calendar(Request $request)
    {
        $user = Auth::user();
        $countries = Country::all();
        $myevents = EventsUsers::where('user_id',$user->id)->get();
        $types = MainType::all();
        $categories = Category::all();
        return view('customer.calendar', ['myevents' => $myevents ,'countries'=>$countries,'types'=>$types,'categories'=>$categories]);
    }
    public function filter_my_calendarc(Request $request)
    {
        
        $user = Auth::user();
        if($request->user_id)
        {
            $user = User::where('id',$request->user_id)->first();
        }
        
        $countries = Country::all();
        $myevents = EventsUsers::where('user_id',$user->id)->whereIn('event_id',Event::where('main_type_id',$request->type)->where('category_id',$request->category)->get(['id']))->get();
       
        $types = MainType::all();
        $categories = Category::all();
        return view('customer.calendar', ['myevents' => $myevents ,'countries'=>$countries,'types'=>$types,'categories'=>$categories]);
    }
    public function account_invites(Request $request)
    {
        $user = Auth::user();
        $countries = Country::all();
        $myevents = EventInvitation::where('email',$user->email)->get();
        $types = MainType::all();
        $categories = Category::all();
        return view('customer.invites', ['myevents' => $myevents ,'countries'=>$countries,'types'=>$types,'categories'=>$categories]);
    }

    public function account_invitations(Request $request)
    {
        $user = Auth::user();
        $countries = Country::all();
        $myevents =Event::whereIn('id', EventInvitation::where('user_id',$user->id)->get(['event_id']))->get();
        $types = MainType::all();
        $categories = Category::all();
        return view('customer.invites', ['myevents' => $myevents ,'countries'=>$countries,'types'=>$types,'categories'=>$categories]);
    }


    public function account_bookings(Request $request)
    {
        $user = Auth::user();
        $countries = Country::all();
        $myevents = Booking::where('user_id',$user->id)->get();
        return view('customer.bookings', ['myevents' => $myevents ,'countries'=>$countries]);
    }
    public function history_details_hosted($id){
    	return view('host.hosted.booking_detail')
		    ->with('event', Event::with(['maintype', 'category.parent', 'multiplePrice.groupPrice'])->find($id));

    }
    public function history_details_booked($id){
    	return view('host.booked.booking_detail')
		    ->with('event', Event::with(['maintype', 'category.parent', 'multiplePrice.groupPrice'])->find($id));

    }

    public function update_customer_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed',
        ]);
        $user = Auth::user();

        $avator = null;

        // check user profile picture
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $avator = time() . $file->getClientOriginalName();
            $path = public_path() . '/uploads/users/';
            $file->move($path, $avator);
        }

        $user->avatar = 'users/'.$avator;
        $user->name = $request->name;
        $user->password =bcrypt($request->password);
        $user->contact_email = $request->contact_email;
        $user->save();
        return redirect(route('my_profile'));
    }
    public function orders($eventId){

    	$orders = Booking::with('details')->where([
    		'event_id' => $eventId,
    		'status'   => Booking::STATUS_PAYIED,
		    ])->get();

    	return view('host.orders')
		    ->with('orders', $orders);
    }
    public function attendees($eventId){

    	$orders = Booking::with('attendees.ticketType')->where([
		    'event_id' => $eventId,
		    'status'   => Booking::STATUS_PAYIED,
	    ])->get();

    	return view('host.attendees')
		    ->with('orders', $orders);
    }

    public function my_tickets($eventId){

    	$orders = Booking::with(['attendees.ticketType', 'event'])->where([
		    'event_id' => $eventId,
		    'user_id'  => auth()->id(),
		    'status'   => Booking::STATUS_PAYIED,
	    ])->get();

    	return view('host.booked.tickets')
		    ->with('orders', $orders);
    }

    public function set_attendees(Request $request){

    	if(!($request->get('attendee_id', false) and in_array($request->get('data', 0), [Attendee::STATUS_ABSENT, Attendee::STATUS_ATTENDED]))){
    		return ['status' => false];
	    }

    	Attendee::where('id', $request->get('attendee_id'))->update(['status' => $request->get('data')]);

    	return ['success' => true, 'data' => $request->get('data')==Attendee::STATUS_ATTENDED? __('Attended'): __('Absent')];
    }

    public function cancel_ticket(Request $request){

    	if(!($request->get('attendee_id', false) and in_array($request->get('data', 0), [Attendee::STATUS_ABSENT, Attendee::STATUS_ATTENDED]))){
    		return ['status' => false];
	    }

	    $attendee = Attendee::with('event')->find($request->get('attendee_id'));

	    if(
		    is_null($attendee->canceled_at) &&
		    $attendee->event->cancellation &&
		    (strtotime($attendee->event->date_from)-($attendee->event->cancellation_days*24*60*60)>time())
	    ){
		    $attendee->update(['canceled_at' => date('Y-m-d')]);

		    return [
			    'success' => true,
			    'data' => __('Canceled')
		    ];
	    }

	    return [
		    'success' => false
	    ];
    }

    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->password);
        if($user->save() && !$validator->errors())
        {
        Session::flash('message', 'Password updated successfully');
        }
        else
        {
            Session::flash('alert', 'Password not updated ');
        }
        return redirect(route('my_account'));
    }
    public function change_notification_setting(Request $request)
    {

        $user = Auth::user();
        $user->notification_type = ($request->notification_type);
        if($user->save())
        {
        Session::flash('message', 'Setting updated successfully');
        }
        else
        {
            Session::flash('alert', 'Setting not updated ');
        }
        return redirect(route('my_account'));
    }
    public function edit_username(Request $request)
    {
        $user = Auth::user();
        $customer =  customers::where('user_id',$user->id)->first();
        if($request->name=='username')
        {
            $user->name = $request->value;
            $customer->full_name = $request->value;

        }
        else if($request->name ='description')
        {
            $customer->description = $request->value;
        }else if($request->name ='email')
        {
            $user->email = $request->value;
        }
        $user->save();
        $customer->save();
        return;
    }
    public function user_profile(Request $request)
    {
        $customer = User::where('id' , $request->user_id)->first();
        return view('customer.publicprofile', ['user' => $customer]);
    }
}
