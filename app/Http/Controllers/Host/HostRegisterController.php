<?php

namespace App\Http\Controllers\Host;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\UserProfessions;
use App\Models\HostsUsers;
use App\Models\UserSocialMedia;
// use Symfony\Component\DomCrawler\Image;
use Validator;

use Session;
use App\Models\Professions;
use App\Models\Country;
use App\User;
use App\Models\Setting;
use App\Mail\NewHostRegister;
use App\Models\UserMedia;
use App\Models\UserCertificateProfession;
use DateTime;
use Mail;
class HostRegisterController extends Controller
{
    public function index()
    {

        $professions = Professions::where('is_active', true)->get();
        $countries = Country::all();

        return view('auth.host_register', ['professions' => $professions, 'countries' => $countries]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'user_type' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $data = $request->all();

        $avator = "users/default.png";
        // check user profile picture
        if ($request->hasFile('avator')) {
            $file = $request->file('avator');
            $avator = 'users/' . time() . md5($file->getClientOriginalName()) .'.' . $file->getClientOriginalExtension();
            $path = public_path() . '/uploads/users/';
            $file->move($path, $avator);
        }
        
        // create user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'contact_email' => $data['email'],
            'avatar' => $avator,
            'password' => Hash::make($data['password']),
            'role_id' => User::HOST_USER_ROLE_ID,
            'type' => $data['user_type'],
            'verification_token' => User::generateVerificationCode(),
            'country_id' => $data['address']['country']
        ]);

        // create host user
        $hostData = $data['host'];
        $hostData['user_id'] = $user->id;
        $hostData['company_certificate'] = null ;

        // check company certifcate file
        if ($request->hasFile('host.certifcate_file')) {
            $company_certifcate_file = $request->file('host.certifcate_file');
            $company_certifcate_file_name = 'hosts_files/' .$user->id . '/company_certifcate/' . time() . md5($company_certifcate_file->getClientOriginalName()) .'.' . $company_certifcate_file->getClientOriginalExtension();
            $company_certifcate_file_path = public_path() . '/uploads/hosts_files/' . $user->id . '/company_certifcate/';
            $company_certifcate_file->move($company_certifcate_file_path, $company_certifcate_file_name);
            $hostData['company_certificate'] = $company_certifcate_file_name; 
        }
       
        HostsUsers::create($hostData);

        // create user professions
        $user->profession()->attach($data['professions']);

        if (!is_null($data['company_certificate_profession_name'][0])) {
        // create user certificate profession
            $company_profession_from = $data['company_certificate_profession_from'];
            $company_profession_to = $data['company_certificate_profession_to'];
            $company_profession_file='';
            if( isset($data['company_profession_file']))
            {
                $company_profession_file = $data['company_profession_file'];
            }


            $company_certificate_professions = [];
            foreach ($request->get('company_certificate_profession_name') as $key => $value) {
                if (!is_null($company_profession_from[$key])) {
                    $company_certificate_professions[] = [
                        'name' => $value,
                        'from' => $company_profession_from[$key],
                        'to' => $company_profession_to[$key],
                    ];
                    
                    // check company profession file
                    if (isset($company_profession_file[$key])) {
                        $certificate_file = $request->file('company_profession_file')[$key];
                        $certificate_name = 'hosts_files/' . $user->id . '/host_profession_certificate/' . time() . md5($certificate_file->getClientOriginalName()) .'.' . $certificate_file->getClientOriginalExtension();
                        $certificate_path = public_path() . '/uploads/hosts_files/' . $user->id . '/host_profession_certificate/';
                        $certificate_file->move($certificate_path, $certificate_name);
                        $company_certificate_professions[$key]['certificate_file'] = $certificate_name;
                    }
                }
            }
            foreach ($company_certificate_professions as $certificate_profession) {
                $user->userCertificate()->create($certificate_profession);
            }
        }
       
        // create user socail media
        if (!is_null($data['social']['link'][0])) {
            $socailLinks = [];
            foreach ($data['social']['type'] as $key => $value) {
                if (!is_null($data['social']['link'][$key])) {
                    $socailLinks[] = [
                        'type' => $value,
                        'link' => $data['social']['link'][$key]
                    ];
                }
            }
            foreach ($socailLinks as $socailLink) {
                $user->socailMedia()->create($socailLink);
            }
        }
        $settings = Setting::find(1);
        $user = User::whereId($user->id)->first()->toArray();
        Mail::to($settings->email_info)->send(new NewHostRegister($user));
        Session::flash('success', "Your registration form is being reviewed by Rizit. We will get back to you accordingly.");
        Session::flash('title', "Congratulations!");
        return redirect()->route('home');
    }
    public function editprofile(Request $request)
    {


        $data = $request->all();
        $user = \Auth::user();
        // create host user
        $host = HostsUsers::where('user_id', $user->id)->first();
        $hostData = $data['host'];
        $addressData = $data['address'];


        $host->email = $hostData['email'];
        $host->starting_year = $hostData['starting_year'];
        $host->landline = $hostData['landline'];
        $host->whatsapp = $hostData['whatsapp'];
        $host->location = $addressData['address'];
        $host->mobile = $hostData['mobile'];

        if (DateTime::createFromFormat('G:i:s', $hostData['work_from']) !== false) {
            $host->work_from = $hostData['work_from'];
        }
        if (DateTime::createFromFormat('G:i:s', $hostData['work_to']) !== false) {
            $host->work_to = $hostData['work_to'];
        }

        if (DateTime::createFromFormat('G:i:s', $hostData['break_from']) !== false) {
            $host->break_from = $hostData['break_from'];
        }
        if (DateTime::createFromFormat('G:i:s', $hostData['break_to']) !== false) {
            $host->break_to = $hostData['break_to'];
        }
        $host->save();

        // create user professions
        $usermedai = UserMedia::where('user_id', $user->id)->delete();

        $usersocial = UserSocialMedia::where('user_id', $user->id)->delete();

        $userprofession = UserCertificateProfession::where('user_id', $user->id)->delete();

        $user->profession()->attach($data['professions']);

        if (!is_null($data['company_certificate_profession_name'][0])) {
        // create user certificate profession
            $company_profession_from = $data['company_certificate_profession_from'];
            $company_profession_to = $data['company_certificate_profession_to'];
         // $company_profession_file = $data['company_profession_file'];

            $company_certificate_professions = [];
            foreach ($request->get('company_certificate_profession_name') as $key => $value) {
                if (!is_null($company_profession_from[$key])) {
                    $company_certificate_professions[] = [
                        'name' => $value,
                        'from' => $company_profession_from[$key],
                        'to' => $company_profession_to[$key],
                        // 'file' => $company_profession_file[$key]
                    ];
                }
            }

            foreach ($company_certificate_professions as $certificate_profession) {
                $user->userCertificate()->create($certificate_profession);
            }
        }

        // create user socail media
        if (!is_null($data['social']['link'][0])) {
            $socailLinks = [];
            foreach ($data['social']['type'] as $key => $value) {
                if (!is_null($data['social']['link'][$key])) {
                    $socailLinks[] = [
                        'type' => $value,
                        'link' => $data['social']['link'][$key]
                    ];
                }
            }
            foreach ($socailLinks as $socailLink) {
                $user->socailMedia()->create($socailLink);
            }
        }

        \Session::flash('success', "Your Account Has Been Updated");
        \Session::flash('title', "Congratulations!");
        return redirect(route('host.my_professions'));
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
                'work_to' => 'required|gt:work_from',
//                'break_from' => 'required',
//                'break_to' => 'required',

            ]);
        } elseif ($request->get('step') == 4) {
            $validator = Validator::make($request->all(), []);
        }
        $customMessages = [
            'required' => 'The :attribute field is required.',
            'lt' => 'The :attribute must be with work from and to.',
            'gt' => 'The :attribute must be with work from and to.'
        ];
        if($request->break_from && $request->break_to){
            $validator = Validator::make(['break_from'=>str_replace(':','',$request->break_from),'break_to'=>str_replace(':','',$request->break_to),'work_from'=>str_replace(':','',$request->work_from),'work_to'=>str_replace(':','',$request->work_to)], [
                'work_from'   => 'required',
                'break_from'  => 'required|gt:work_from',
                'work_to'     => 'required|gt:work_from',
                'break_to'    => 'required|lt:work_to|gt:break_from' ,
            ],$customMessages);
//            $validator = Validator::make($request->all(), [
//                'work_from.required'      => 'Work from is required',
//                'break_from.required|gt:work_from'    => 'Break from is required and must be after working start',
//                'work_to.required|gt:work_from'      => 'Work to is required and must be before working start',
//                'break_to.required|lt:work_to|gt:break_from'   => 'Break to is required and must be before working to and after break from',
//            ]);
        }

        if ($validator->passes()) {
            return response()->json(['success' => true]);
        }


        return response()->json(['error' => $validator->errors()]);
    }

}
