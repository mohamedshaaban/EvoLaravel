<?php

namespace App\Http\Controllers\Host;

use App\Models\BalanceTransaction;
use App\Models\Booking;
use App\Models\EasPrice;
use App\Models\Professions;
use App\Models\UserBadges;
use App\Models\UserCertificateProfession;
use App\Models\UserMedia;
use App\Models\UserNotified;
use App\Models\UserSocialMedia;
use App\Models\UsersRating;
use App\Models\UserTermsPrivacy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use App\Models\EventsUsers;
use Validator;
use Session;
use App\Models\MainType;
use App\Models\Category;
use App\Models\Event;
use App\Models\HostsUsers;
use App\Models\UserFavoriteHosts;
use App\Models\EventInvitation;
class HostsController extends Controller
{

    public function account_info(Request $request)
    {
        $user = Auth::user();
        $countries = Country::all();
        return view('host.account', ['user' => $user, 'countries' => $countries]);
    }

    public function account_profile(Request $request)
    {
        $user = Auth::user();
        $countries = Country::all();
        return view('host.profile', ['user' => User::where('id', $user->id)->first(), 'countries' => $countries]);
    }

    public function account_media(Request $request)
    {
        $user = Auth::user();
        return view('host.media', ['user' => User::where('id', $user->id)->first()]);
    }
    public function account_contacts(Request $request)
    {
        $user = Auth::user();
        $countries = Country::all();
        return view('host.contacts', ['user' => User::where('id', $user->id)->first(), 'countries' => $countries]);
    }
    public function account_badges(Request $request)
    {
        $user = Auth::user();
        $countries = Country::all();
        return view('host.badges', ['user' => User::where('id', $user->id)->first(), 'countries' => $countries]);
    }
    public function account_favorite_hosts(Request $request)
    {
        $user = Auth::user();
        $countries = Country::all();

        $favorites = HostsUsers::whereIn('id', UserFavoriteHosts::where('user_id', $user->id)->get(['host_id']))->get();
        return view('host.favorite_hosts', ['hosts' => $favorites, 'countries' => $countries]);
    }
    public function account_calendar(Request $request)
    {
        $user = Auth::user();
        $countries = Country::all();
        $myevents = Event::where('host_id', $user->id)->get();
        $types = MainType::all();
        $categories = Category::all();
        $calevents = array();
        foreach ($myevents as $event)
        {
            if ($event->type == Event::TYPE_EVENT) {
                $event_color = Event::EVENT_COLOR;
            } else if ($event->type == Event::TYPE_ACTIVITY) {
                $event_color = Event::ACTIVITY_COLOR;
            } else {
                $event_color = Event::SERVICE_COLOR;
            }
            $calevents[] = "{id: $event->id,title: \"" . $event->title_en . "\",start: \"" . $event->date_from . "\",end: \"" . $event->date_to . "\",color:\"$event_color\" }";

        }

        $allevents = implode(',',$calevents);

        return view('host.calendar', ['myevents' => $allevents, 'countries' => $countries, 'types' => $types, 'categories' => $categories]);
    }
    public function filter_my_calendar(Request $request)
    {
         
        $user = Auth::user();
        $host = HostsUsers::where('user_id',$user->id)->first();
        if($request->user_id)
        {
            $host = HostsUsers::find($request->user_id);
            $user = User::where('id',$host->user_id)->first();
        }
       
        $countries = Country::all();
        $myevents = Event::where('host_id',$host->id)->where('main_type_id', $request->type)->get();
        //'user_id', $user->id
        
        $types = MainType::all();
        $categories = Category::all();
        
        return view('customer.calendar', ['myevents' => $myevents, 'countries' => $countries, 'types' => $types, 'categories' => $categories]);
    }
    public function account_invites(Request $request)
    {
        $user = Auth::user();
        $countries = Country::all();
        $myevents = Event::whereIn('id', EventInvitation::where('email', $user->email)->get(['event_id']))->get();
        $types = MainType::all();
        $categories = Category::all();
        return view('host.invites', ['myevents' => $myevents, 'countries' => $countries, 'types' => $types, 'categories' => $categories]);
    }
    public function account_invitations(Request $request)
    {
        $user = Auth::user();
        $countries = Country::all();
        $myevents = Event::whereIn('id', EventInvitation::where('user_id', $user->id)->get(['event_id']))->get();

        $types = MainType::all();
        $categories = Category::all();
        return view('host.invitations', ['myevents' => $myevents, 'countries' => $countries, 'types' => $types, 'categories' => $categories]);
    }

    public function my_history_hosted(Request $request)
    {
        $countries = Country::all();
        $host = HostsUsers::where('user_id',Auth::id())->first();
        if($host){
	        $myevents = Event::where('host_id', $host->id);

	        if($request->get('type', false)){
		        $myevents = $myevents->where('main_type_id', $request->get('type'));
	        }

	        if($request->get('cate', false)){
		        $myevents = $myevents->whereIn('category_id', request()->get('cate', []));
	        }

	        if($request->get('date', false)){
		        $myevents = $myevents->whereRaw('"'.$request->get('date').'" between date_from and date_to');
	        }

	        $myevents = $myevents->get();
        }
        else {
	        $myevents= [];
        }

        return view('host.hosted.bookings', [
        	'myevents'   => $myevents,
	        'countries'  => $countries,
	        'categories' => Category::with('parent')
	                                ->where('category_id', '!=',0)
	                                ->orderBy('category_id')
	                                ->get()
        ]);
    }

    public function my_history_booked(Request $request)
    {
        $countries = Country::all();
        $events = Event::whereHas('booking', function($query){
        	$query->where('user_id', Auth::id());
		});

        if($request->get('type', false)){
	        $events = $events->where('main_type_id', $request->get('type'));
        }

        if($request->get('cate', false)){
	        $events = $events->whereIn('category_id', request()->get('cate', []));
        }

        if($request->get('date', false)){
	        $events = $events->whereRaw('"'.request('date').'" between date_from and date_to');
        }

        return view('host.booked.bookings', [
        	'myevents'   => $events->get(),
	        'countries'  => $countries,
	        'categories' => Category::with('parent')
	                                ->where('category_id', '!=',0)
	                                ->orderBy('category_id')
	                                ->get()
        ]);
    }

    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->password);
        if ($user->save() ) {

            Session::flash('message', 'Password updated successfully');
        } else {

            Session::flash('alert', 'Password not updated ');
        }
        return redirect(route('host.my_account'));
    }
    public function edit_username(Request $request)
    {
        $user = Auth::user();
        $host = HostsUsers::where('user_id', $user->id)->first();

        if ($request->name == 'username') {
            $user->name = $request->value;
            $host->company_name = $request->value;

        } else if ($request->name == 'description') {
            $host->description = $request->value;
        }
        else if ($request->name == 'hostwebsite') {
            $host->website = $request->value;

        }
        else if ($request->name == 'hostcontactemail') {
            $user->contact_email = $request->value;
            $host->email = $request->value;
        }
        else if ($request->name == 'hostlandline') {
            $host->landline = $request->value;
        }
        else if ($request->name == 'hostwhatsapp') {
            $host->whatsapp = $request->value;
        }
        else if ($request->name == 'hostlocation') {
            $host->location = $request->value;
        }
        else if ($request->name == 'hostmobile') {
            $host->mobile = $request->value;
        }
        else if ($request->name == 'email') {
            $user->email = $request->value;
            $host->email = $request->value;
        }
        $user->save();
        $host->save();
        return;
    }
    public function my_terms(Request $request)
    {
        $user = Auth::user();
        $userterms = UserTermsPrivacy::where('user_id', $user->id)->where('type',UserTermsPrivacy::TERMS_CONDITIONS)->first();

        return view('host.privacy_terms', ['data' => $userterms, 'type'=>UserTermsPrivacy::TERMS_CONDITIONS]);
    }
    public function my_privacy(Request $request)
    {
        $user = Auth::user();
        $userterms = UserTermsPrivacy::where('user_id', $user->id)->where('type',UserTermsPrivacy::PRIVACY_POLICY)->first();


        return view('host.privacy_terms', ['data' => $userterms , 'type'=>UserTermsPrivacy::PRIVACY_POLICY]);
    }
    public function account_balance()
    {
        $user = Auth::user();
        $balance = BalanceTransaction::where('user_id',$user->id)->orderBy('id', 'desc')->first();
        $services = EasPrice::all();
        return view('host.balance',['user'=>$user,'balance'=>$balance ,'services'=>$services]);
    }
    public function add_terms_privacy(Request $request)
    {
        $user = Auth::user();

        $content = UserTermsPrivacy::where('user_id', $user->id)->where('type',$request->type)->first();
        if(!$content)
        {
            $content = new UserTermsPrivacy();
            $content->user_id = $user->id;
            $content->content = $request->desc;
            $content->type = $request->type ;

            $content->save();

        }
        else
        {
            $content->content = $request->desc;
            $content->update();

        }

        if($request->type == 2)
        {
            return redirect(route('host.my_terms'));
        }
        else
        {
            return redirect(route('host.my_privacy'));
        }

    }
    public function change_profile_picture(Request $request)
    {
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
        $user->save();
        return redirect(route('host.my_professions'));

    }

    public function update_host_profile(Request $request)
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
        return redirect(route('host.my_profile'));

    }
    public  function my_ratings(Request $request)
    {
        $user = Auth::user();
        $countries = Country::all();
        $ratings = UsersRating::where('host_id', $user->id)->get();
        $types = MainType::all();
        $categories = Category::all();
        return view('host.ratings', ['ratings' => $ratings, 'countries' => $countries, 'types' => $types, 'categories' => $categories]);


    }
    public function host_profile(Request $request)
    {
        $user = User::where('name',$request->host_name)->first();
        
        $hostuser = HostsUsers::where('user_id',$user->id)->first();
        $checked = false;
        if(Auth::user())
        {
            $usernotified = UserNotified::where('user_id',Auth::user()->id)->where('host_id',$request->host_id)->first();
            if($usernotified)
            {
                $checked = true;
            }

        }

        return view('host.userprofile', ['host' => $hostuser,'checked'=>$checked]);
    }
    public function host_event_profile(Request $request)
    {
        $hostuser = HostsUsers::where('user_id',$request->host_id)->first();
        $checked = false;
        if(Auth::user())
        {
            $usernotified = UserNotified::where('user_id',Auth::user()->id)->where('user_id',$request->host_id)->first();
            if($usernotified)
            {
                $checked = true;
            }

        }

        return view('host.userprofile', ['host' => $hostuser,'checked'=>$checked]);
    }

    public function host_media(Request $request)
    {
        $host = HostsUsers::where('id', $request->host_id)->first();
        $userimage = UserMedia::where('user_id',$host->user_id)->where('type',2)->get();
        $uservideos= UserMedia::where('user_id',$host->user_id)->where('type',3)->get();
        
        return view('host.hostmedia',['host'=>$host,'media'=>$userimage,'videos'=>$uservideos]) ;
    }
    public function upload_media(Request $request)
    {
        $mediacount = UserMedia::where('user_id',Auth::user()->id)->where('type',$request->type)->count();
        if($request->type == 2)
        {
            if($mediacount >= 5) {
            Session::flash('message', 'You reach the limit');
            return redirect(route('host.my_media'));
        }
        }
            else
            {
                if($mediacount >= 2) {
                    Session::flash('message', 'You reach the limit');
                    return redirect(route('host.my_media')) ;
                }
            }
        $usermedia = new UserMedia();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $avator = 'uploads/media/' . time() . $file->getClientOriginalName();
            $path = public_path() . '/uploads/media/';
            $file->move($path, $avator);
        }
        if($request->type == 2) {
            $usermedia->media = $avator;
        }
        else
        {
            $usermedia->media = $request->video;
        }
        $usermedia->user_id = Auth::user()->id;
        $usermedia->type = $request->type;
        $usermedia->caption = $request->caption;
        $usermedia->save();
        return redirect(route('host.my_media')) ;
    }
    public function deletemedia(Request $request)
    {
        $usermedai = UserMedia::where('id',$request->media_id)->first();
        $usermedai->delete();
        return;
    }
    public function deletesocial(Request $request)
    {
        $usermedai = UserSocialMedia::where('id',$request->social_id)->first();
        $usermedai->delete();
        return;
    }
    public function deletecertificate(Request $request)
    {
        $usermedai = UserCertificateProfession::where('id',$request->certiificate_id)->first();
        $usermedai->delete();
        return;
    }
    public function filter_host_calendar(Request $request)
    {
        $query  = Event::select( '*' );
	if($request->date) 
            {          
            $mytime= $request->date;
                 $query->Where(function($q) use ($mytime) {
                    $q->Where( 'date_from', '>=', $mytime );
                    $q->orwhere('date_to', '<=', $mytime);
                });
            }
        

                        
        $query->where('host_id', $request->host_id);
        $query->where('main_type_id',$request->type);
        
        $host = HostsUsers::where('id', $request->host_id)->first();
        $user = User::where('id', $host->user_id)->first();
        $countries = Country::all();
        $myevents = $query->get();

        $types = MainType::all();
        $categories = Category::all();
        $calevents = array();
        foreach ($myevents as $event)
        {
            if ($event->type == Event::TYPE_EVENT) {
                $event_color = Event::EVENT_COLOR;
            } else if ($event->type == Event::TYPE_ACTIVITY) {
                $event_color = Event::ACTIVITY_COLOR;
            } else {
                $event_color = Event::SERVICE_COLOR;
            }
            $calevents[] = "{id: $event->id,title: \"" . $event->title_en . "\",start: \"" . $event->date_from . "\",end: \"" . $event->date_to . "\",color:\"$event_color\" }";

        }

        $allevents = implode(',',$calevents);

        return view('host.hosteditems', ['host'=>$host,'events'=>$myevents,'myevents' => $allevents, 'countries' => $countries, 'types' => $types, 'categories' => $categories]);

    }
    public function hosted_items(Request $request)
    {

        $host = HostsUsers::where('id', $request->host_id)->first();
        $user = User::where('id', $host->user_id)->first();
        $countries = Country::all();
        $myevents = Event::where('host_id', $request->host_id)->get();

        $types = MainType::all();
        $categories = Category::all();
        $calevents = array();
        foreach ($myevents as $event)
        {
            if ($event->type == Event::TYPE_EVENT) {
                $event_color = Event::EVENT_COLOR;
            } else if ($event->type == Event::TYPE_ACTIVITY) {
                $event_color = Event::ACTIVITY_COLOR;
            } else {
                $event_color = Event::SERVICE_COLOR;
            }
            $calevents[] = "{id: $event->id,title: \"" . $event->title_en . "\",start: \"" . $event->date_from . "\",end: \"" . $event->date_to . "\",color:\"$event_color\" }";

        }

        $allevents = implode(',',$calevents);

        return view('host.hosteditems', ['host'=>$host,'events'=>$myevents,'myevents' => $allevents, 'countries' => $countries, 'types' => $types, 'categories' => $categories]);

    }
    public function host_rating(Request $request)
    {
        $host = HostsUsers::where('id', $request->host_id)->first();
        $userreviews = UsersRating::where('host_id',$request->host_id)->get();
        $host_events = Event::where('host_id',$request->host_id)->get();
        return view('host.hostreviews',['user_reviews'=>$userreviews,'host_events'=>$host_events,'host'=>$host]);
    }
    public function review_host(Request $request)
    {
        $user_review = new UsersRating();
        $user_review->user_id = $request->user_id;
        $user_review->host_id = $request->host_id;
        $user_review->comment = $request->comment;
        $user_review->rating = $request->rating;

        if ($user_review->save()) {
            Session::flash('message', 'Your review sent successfully');
        } else {
            Session::flash('alert', 'Sorry review not sent ');
        }
        return redirect()->route('host_rating', ['host_id' => $request->host_id]);
    }
        public function host_badges(Request $request)
        {
            $host = HostsUsers::where('id', $request->host_id)->first();
            $badges = User::where('id' , $host->user_id)->first();

            return view('host.profilebadges',['user'=>$badges,'host'=>$host]);
        }
public  function list_hosts(Request $request)
{
    if($request->host_name)
    {

    }
    else
    {
        $hosts = HostsUsers::whereIn('user_id',User::where('country_id',$request->session()->get('country'))->get(['id']))->where('prviate_host',0)->get();
    }

    return view('host.listhosts',['hosts'=>$hosts,'professions'=>Professions::all()]);
}
public function my_professions(Request $request)
{
    $user = Auth::user();
    $hosts = HostsUsers::where('user_id',$user->id)->first();
    $pro_array= array();
    
    foreach ($hosts->user->profession as $profession)
    {

        $pro_array[]=$profession->id;
    }

    return view('host.my_professions',['user' => User::where('id', $user->id)->first(),'host'=>$hosts,'professions'=>Professions::all(),'host_pro'=>$pro_array]);

}
}
