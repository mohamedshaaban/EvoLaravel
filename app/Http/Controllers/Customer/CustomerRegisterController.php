<?php

namespace App\Http\Controllers\Customer;

use App\Models\customers;
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

class CustomerRegisterController extends Controller
{

    public function index()
    {


        $countries = Country::all();

        return view('auth.customer_register', ['countries' => $countries]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        Validator::make($request->all(), [
            'name' => 'required',

            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $data = $request->all();

        $avator = null;
        
        // check user profile picture
        if ($request->hasFile('avator')) {
            $file = $request->file('avator');
            $avator = time() . $file->getClientOriginalName();
            $path = public_path() . '/uploads/users/';
            $file->move($path, $avator);
        }
        
        // create user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'avatar' => 'users/'.$avator,
            'password' => Hash::make($data['password']),
            'role_id' => User::NORMAL_USER_ROLE_ID,
            'verification_token' => User::generateVerificationCode(),
            'notification_type'=>$data['notification_type'],
            'status'=>1
        ]);



        $customerData['user_id'] = $user->id;
        $customerData['full_name'] = $data['full_name'];
        $customerData['date_of_birth'] = $data['date_of_birth'];
        $customerData['is_active'] = 1;
        $customerData['gender'] = $data['gender'];
        $customerData['country_id'] = $data['country_id'];
        $customerData['description'] = $data['description'];
        customers::create($customerData);
       
        // create user socail media
        $socailLinks = [];
        foreach ($data['social']['type'] as $key => $value) {
            $socailLinks[] = [
                'type' => $value,
                'link' => $data['social']['link'][$key]
            ];
        }
        foreach ($socailLinks as $socailLink) {
            $user->socailMedia()->create($socailLink);
        }
         if($this->guard()->attempt($this->credentials($request), $request->filled('remember')))
         {
             return redirect(route('home'));
         }
        
        // return 
    }

    public function validation(Request $request)
    {


        if ($request->get('step') == 1) {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'user_type' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed',
            ]);

        } elseif ($request->get('step') == 2) {

            if ($request->get('user_type') == 3) {
                $validator = Validator::make($request->all(), [
                    'starting_year' => 'required',
                    'certifcate_file' => 'required',
                    'professions' => 'required',
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    'professions' => 'required',
                ]);
            }
        } elseif ($request->get('step') == 3) {
            $validator = Validator::make($request->all(), [
                'whatsapp' => 'required',
                'mobile' => 'required',
                'email' => 'required',
                'company_name' => 'required',
                'work_from' => 'required',
                'work_to' => 'required',
                'break_from' => 'required',
                'break_to' => 'required',

            ]);
        } elseif ($request->get('step') == 4) {
            $validator = Validator::make($request->all(), []);
        }

        if ($validator->passes()) {
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => $validator->errors()]);
    }
    public function username()
    {
        return 'email';
    }
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }
    protected function guard()
    {
        return Auth::guard();
    }
}
