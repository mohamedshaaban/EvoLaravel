<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Models\Services;
use App\Models\Area;
use App\Models\LoyatlyPoints;
use App\Models\OrderItems;
use App\Models\Posts;
use App\Models\Product;
use App\Models\SpecialDatesCategories;
use App\Models\UserAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Redirect;
use App\facades__\Wishlist;
use Cart;
use Alert;
use Illuminate\Support\Facades\Validator;
use App\Mail\VerifyMail;
use Mail;
use App\Models\SpecialDates;
use App\Models\Report;
use App\Transformers\UserTransformer;
use Dingo\Api\Routing\Helpers;


class UserController extends Controller
{
    use Helpers;

    public function show(Request $request)
    {

        $users = User::paginate(10);


        return $this->response->array($users->toArray());
    }

    public function login(Request $request)
    {

        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
               $user =User::where('email', request('email'))->where('password',Hash::make( request('password')))->first();
            $user = Auth::user()->first();
           
            $token = $user->createToken('rizit')->accessToken;
            return $this->response->array(['status' => $this->successStatus,'message'=>'Successfully','token'=>$token,'user_data'=>$user] );
        } else {
            return $this->response->array(['status' => $this->successStatus,'message'=>'Invalid Username or password'] );
        }
    }
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|numeric|digits:8',
            'password' => 'required|string|min:6|confirmed',
            'terms'=>'required',
            'is_newsletter'=>'required',
            'date_of_birth'=>'required'
        ]);
        if($validate->fails())
        {

            return ['status'=>'false','errors'=>$validate->errors()->all()];

        }


        $code = 'EN' . Carbon::now().$request->first_name;

        $user =  User::create([
            'name' => $request->first_name .' '.$request->last_name,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'password' => Hash::make($request->password),
            'key'=>preg_replace('/[^A-Za-z0-9\-]/', '', Hash::make($code)),
            'is_newsletter'=>$request->is_newsletter
        ]);
        return $this->response->array(['status' => $this->successStatus,'message'=>'Plesae check your email to activate your account '] );
    }
    
    public function profile(Request $request)
    {
        $user = Auth::user();
        return $this->response->array(['status' => $this->successStatus,'message'=>'Successfully','user'=>$user->toArray()] ); 
    }
    
    public function loyaltyPoints(Request $request)
    {
        $user =Auth::user();
        $loyatlypointsposts = Posts::where('category_id',1)->whereStatus(1)->get();
        return $this->response->array(['status' => $this->successStatus,'message'=>'Successfully','loyatlypointsposts'=>$loyatlypointsposts->toArray()] ); 
    }
    public function updateProfile(Request $request)
    {
    		if( Auth::user()->email != $request->email)
		{
			$errors = Validator::make($request->all(), [
				'email' => 'required|string|email|max:255|unique:users',
			]);
			if($errors->fails())
			{
                                return $this->response->array(['status' => $this->successStatus,'message'=>'Failed','errors'=>$errors->errors()->all()->toArray()] );
			}
			$updateuser = Auth::user();
			$updateuser->change_email = $request->email;
			$updateuser->save();


			$user = Auth::user();
			Mail::to(Auth::user()->email)->send(new VerifyMail($user));
		}
		$user = Auth::user()->update([
			'name'=>$request->first_name.' '.$request->last_name,
			'first_name'=>$request->first_name,
			'last_name'=>$request->last_name,
		]);
                        return $this->response->array(['status' => $this->successStatus,'message'=>'Your Account has been updated'] );

    }
    public function updatePassword(Request $request)
    {
        $validate = Validator::make($request->all(), [
			'old_password'=>'required',
			'password' => 'required|string|min:6|confirmed',
		]);
		if($validate->fails())
		{
			return $this->response->array(['status' => $this->successStatus,'message'=>'You password not updated','errors'=>$validate->errors()] );
		}
		$credentials = array(
			'email' => Auth::user()->email,
			'password' => ($request->old_password),
			'is_active' => 1
		);

		if (Auth::check($credentials))
		{
			$user = Auth::user()->update([
				'password'=>bcrypt($request->password),

			]);
                        
                        return $this->response->array(['status' => $this->successStatus,'message'=>'Successfully'] );
		}
		else
		{
			return $this->response->array(['status' => $this->successStatus,'message'=>'You password not updated'] );

		}

    }
}
