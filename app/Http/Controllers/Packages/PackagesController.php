<?php

namespace App\Http\Controllers\Packages;

use App\Models\BalanceTransaction;
use App\Models\EasPrice;
use App\Models\Packages;
use App\Models\UsersRating;
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
use Carbon\Carbon;
class PackagesController extends Controller
{

  public function list_plans(Request $request)
  {
      $eas = EasPrice::all();
      $packages = Packages::all();
      return view('host.packages',['eas'=>$eas,'packages'=>$packages]);

  }
  public function add_new_eas(Request $request)
  {
      
      $user = Auth::user();
      $balance_transaction = new BalanceTransaction();
      if($request->amount[0]!=0)
      {
          $user->number_of_events  = $user->number_of_events + $request->amount[1];
          $id =1 ;
      }
      if($request->amount[1]!=0)
      {
          $user->number_of_activity  = $user->number_of_activity + $request->amount[2];
          $id =2 ;
      }
      if($request->amount[2]!=0)
      {
          $user->number_of_services  = $user->number_of_services + $request->amount[0];
          $id = 3;
      }
      $balance_transaction->user_id = $user->id;
      $balance_transaction->purchase_date = Carbon::today();
      $balance_transaction->duration_Date = Carbon::today()->addDays(30);
      $balance_transaction->use_eas_id = $id;
      $balance_transaction->number_of_events = $request->amount[0] ;
      $balance_transaction->number_of_activity = $request->amount[1] ;
      $balance_transaction->number_of_services = $request->amount[2] ;
      $balance_transaction->total = 100 ;
      $balance_transaction->save();
        $user->save();

      return redirect(route('host.account_balance'));
  }
  public function add_new_package(Request $request)
  {
      $user = Auth::user();
      $balance_transaction = new BalanceTransaction();
      $package = Packages::where('id',$request->package_id)->first();
      $user->number_of_events  = $user->number_of_events + $package->num_of_events;
      $user->number_of_activity  = $user->number_of_activity + $package->num_of_activity;
      $user->number_of_services  = $user->number_of_services + $package->num_of_services;
      $user->save();
      $balance_transaction->user_id = $user->id;
      $balance_transaction->user_package_id = $request->package_id;
      $balance_transaction->purchase_date = Carbon::today();
      $balance_transaction->duration_Date = Carbon::today()->addDays($package->duration);
      $balance_transaction->number_of_events = $package->num_of_events  ;
      $balance_transaction->number_of_activity = $package->num_of_activity ;
      $balance_transaction->number_of_services = $package->num_of_services ;
      $balance_transaction->total = $package->price ;
      $balance_transaction->save();

      return redirect(route('host.account_balance'));
  }
}
