<?php

namespace App\Admin\Controllers\Event;

use App\Models\Attendee;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Event;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class CanceledTicketController extends Controller
{

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content, $id)
    {
    	$event = Event::find($id);

        return $content
            ->header('Canceled Ticket')
            ->description('Event: '.$event->title())
            ->body($this->grid($id));
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid($id)
    {

        $grid = new Grid(new Attendee);
        $grid->model()
             ->orderBy('id', 'desc')
             ->where('event_id', $id)
             ->whereNotNull('canceled_at');


	    $grid->disableActions();
	    $grid->disableCreateButton();
	    $grid->disableRowSelector();


	    $grid->filter(function ($filter) use ($id) {
		    $filter->equal('ticket_type')->select(\App\Models\EventMultiplePrice::where('event_id', $id)->get(['name_en', 'id'])->pluck('name_en', 'id'));
		    $filter->equal('seat_no');
			$filter->equal('email');
			$filter->equal('mobile');
			$filter->equal('qr');
			$filter->equal('seat_id');
        });

        $grid->id('ID');
        $grid->ticketType()->name_en('Ticket Type');
        $grid->qr('QR');
        $grid->seat_no('Seat No#');
	    $grid->email('Email');
	    $grid->name('Name');
        $grid->mobile('Mobile');
        $grid->created_at('Created Date');
        $grid->canceled_at('Canceled Date');

        $grid->column('Booking')->display(function () {
        	$link = route('admin.booking', $this->booking_id);

            return
"<a class=\"btn btn-xs btn-default grid-open-map\" href='{$link}'>
    <i class=\"fa fa-user\"> View</i>
</a>";
        });
        return $grid;
    }

	/**
	 * Index interface.
	 *
	 * @param Content $content
	 * @return Content
	 */
	public function indexBooking(Content $content, $id)
	{
		$booking = Booking::with('event')->findOrFail($id);

		return $content
			->header('Booking')
			->description('Event: '.$booking->event->title())
			->body($this->gridBooking($id));
	}

	/**
	 * Make a grid builder.
	 *
	 * @return Grid
	 */
	protected function gridBooking($id)
	{
		$grid = new Grid(new BookingDetail());
		$grid->model()
		     ->orderBy('id', 'desc')
		     ->where('booking_id', $id);

		$grid->disableActions();
		$grid->disableCreateButton();
		$grid->disableRowSelector();


		$grid->id('ID');
		$grid->groupPrice()->name_en('Group Price');
		$grid->quantity('Quantity');
		$grid->total_price('Total Price');
		$grid->created_at('Created At');

		return $grid;
	}
}
