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


class UserAddressController extends Controller
{
    use Helpers;
    
    public function addresses(Request $request)
    {
        $user = Auth::user();
        return $this->response->array(['status' => $this->successStatus,'message'=>'Successfully','addresses'=>$user->userAddress->toArray()] ); 
    }   
    
    public function deleteAddress(Request $request)
    {
        $user = Auth::user();
        $address = UserAddress::whereId($request->address_id)->delete() ;
        if($address)
        {
            return $this->response->array(['status' => $this->successStatus,'message'=>'Successfully','addresses'=>$user->userAddress->toArray()] );  
        }
        return $this->response->array(['status' => $this->successStatus,'message'=>'Failed Address not found','addresses'=>$user->userAddress->toArray()] );  
    }
    
    public function saveAddress(Request $request)
    {
        $user = Auth::user();
        $request['user_id'] = $user->id;
        $newaddress = UserAddress::create($request->all());
        $user->refresh();
        if($newaddress)
        {
            return $this->response->array(['status' => $this->successStatus,'message'=>'Successfully','addresses'=>$user->userAddress->toArray()] );  
        }
        return $this->response->array(['status' => $this->successStatus,'message'=>'Failed , Address not saved ','addresses'=>$user->userAddress->toArray()] );  
    }    
        public function updateAddress(Request $request)
    {
        $user = Auth::user();
        $request['user_id'] = $user->id;
        $newaddress = UserAddress::whereId($request->address_id)->update($request->all());
        $user->refresh();
        if($newaddress)
        {
            return $this->response->array(['status' => $this->successStatus,'message'=>'Successfully','addresses'=>$user->userAddress->toArray()] );  
        }
        return $this->response->array(['status' => $this->successStatus,'message'=>'Failed , Address not updated  ','addresses'=>$user->userAddress->toArray()] );  
    }    
    
}
