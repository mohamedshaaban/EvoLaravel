<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 10/1/18
 * Time: 11:16 AM
 */

namespace App\Http\Controllers;

use App\Models\Country;
use App\User;
use App\Models\UserContacts;
use App\Models\HostsUsers;
use App\Models\UserFavoriteHosts;
use Illuminate\Http\Request;
use Auth;

class SettingsController extends Controller {

	public function city($country){
		return Country::findOrFail($country)->cities()->get(['id', 'name_en', 'name_ar']);
	}

	public function user(Request $request){
            $userids = array();
           
            $contacts = UserContacts::where('user_id',Auth::user()->id)->get();
            
            $UserFavoriteHosts = UserFavoriteHosts::where('user_id',Auth::user()->id)->get();
            foreach($contacts as $user )
            {
                $userdetails = User::where('name',$user->name)->first();
                
                if($userdetails)
                {
                    $userids[]=$userdetails->id;
                }
                
            }
            
            foreach($UserFavoriteHosts as $user )
            {
                $userdetails = HostsUsers::find($user->host_id);
                if($userdetails)
                {
                    $userids[]=$userdetails->user_id;
                }
                
            }
            
		$user = User
                ::whereIn('id', $userids)
                ->where('id','!=',Auth::user()->id)
                ->Where(function($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->get('term') . '%');
                    $q->orWhere('email', 'like', '%' . $request->get('term') . '%');
                })
                ->limit(8)
                ->get(['id', 'name', 'email']);

        return ['status' => true, 'data'=>$user];
	}
}