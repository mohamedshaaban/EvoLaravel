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


class SpecialDateController extends Controller
{
    use Helpers;
    
    public function spcialDate(Request $request)
    {
         $user =Auth::user();
        return $this->response->array(['status' => $this->successStatus,'message'=>'Successfully','specialdates'=>$user->SpecialDates->toArray()] ); 
    }
    
    public function spcialDateCategories(Request $request)
    {
        
        $SpecialDatesCategories = SpecialDatesCategories::all();
        return $this->response->array(['status' => $this->successStatus,'message'=>'Successfully','specialdatescategories'=>$SpecialDatesCategories->toArray()] ); 
    }   
    
    public function deleteSpcialDate(Request $request)
    {
        
        $SpecialDatesCategories = SpecialDatesCategories::where('id',$request->date_id)->delete();
        if(!$SpecialDatesCategories)
        {
            $this->successStatus = env("API_FAILURE_STATUS") ;
        return $this->response->array(['status' => $this->successStatus,'message'=>'Date not found','specialdatescategories'=>SpecialDatesCategories::all()->toArray()] );                     
        }
        return $this->response->array(['status' => $this->successStatus,'message'=>'Date deleted successfully','specialdatescategories'=>SpecialDatesCategories::all()->toArray()] );         
    }
    
}
