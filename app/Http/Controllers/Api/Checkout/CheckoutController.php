<?php

namespace App\Http\Controllers\Api\Checkout;

use App\Http\Models\Services;
use App\Models\Area;
use App\Models\LoyatlyPoints;
use App\Models\OrderItems;
use App\Models\Posts;
use App\Models\Product;
use App\Models\ProductReviews;
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
use App\Models\Order;
use App\Transformers\UserTransformer;
use Dingo\Api\Routing\Helpers;


class CheckoutController extends Controller
{
    use Helpers;
    
    public function addReview(Request $request)
    {
        $productReview = ProductReviews::updateOrCreate(['user_id'    => Auth::user()->id,
			'product_id' => $request->product_id], [
			
			'rate'       => $request->rate,
			'comment'    => $request->comment
		] );
        $product = Product::findOrFail($request->product_id);
        
        if($product && $productReview)
        {
            return $this->response->array(['status' => $this->successStatus,'message'=>'Successfully','reviews'=>$product->ProductReviews->toArray()] );  
        }
        $this->successStatus = env("API_FAILURE_STATUS") ;
        return $this->response->array(['status' => $this->successStatus,'message'=>'Failed'] );  
    }
 
    public function addToCart(Request $request)
    {
		$product = Product::findOrFail( $request->product_id );

		$product->setQuantity( $request->get( 'quantity', 0 ) );
		$product->setOptionsData( $request->all() );

		$cart = Cart::getContent( 'user_id', Auth::id() ?: session( 'tempUserId' ) );
                
		if ( count( $cart ) ) {
			if ( $request->area && $request->area != 'Please Select Area' && array_first( $cart )->area != $request->area ) {
				return [ 'status' => 'areamismatched' ];
			}
		}

		if ( ! checkAvailableSessionTime( $request->date, $request->time, $product,  $request->area) && $request->is_waiting == 0 ) {
			return [ 'status' => false, 'message' => 'Time is not available' ];
		}


		$error = [];
		foreach ( $product->getOptions() as $option ) {
			if ( $option->getIsRequired() ) {
				$value = $request->get( 'option_' . $option->id );
				if (
					empty( $value ) &&
					$value !== 0 &&
					$value !== "0"

				) {
					$error[] = 'option_' . $option->id;
				}
			}
		}

		if ( $error ) {
			return [ 'status' => false, 'message' => 'Please fill all required filed', 'required' => $error ];
		}


		$request->merge( [
			'cart_waiting'     => $request->is_waiting,
			'is_confirmed'     => $product->vendor->trusted,
			'product_quantity' => $request->quantity,
			'quantity'         => [
				'relative' => false,
				'value'    => 1
			]
		] );


		$status = 'update';

		if ( ! Cart::has( $product->id ) ) {
                    
			if ( $request->is_waiting == 1 ) {
				Report::addedToWaitingList( $product );
			} else {
				Report::addedToCart( $product );
			}
			Cart::add( $product->id, $product->getNameEn(), 1, 1 );
			$status = 'new';
		}

		Cart::update( $product->id, $request->except( [ '_token', 'is_waiting' ] ) );
 
		$product = [
			'status'     => $status,
			'name'       => $product->getName(),
			'image'      => asset( ( $product->getMainPicture() ) ?: 'images/nophoto.svg' ),
			'total'      => Cart::getTotal(),
			'date'       => $request->date,
			'time'       => $request->time,
			'countitems' => Cart::getContent()->count()
		];
                return $this->response->array(['status' => $this->successStatus,'message'=>'Successfully','product'=>$product] ); 
	}
}
