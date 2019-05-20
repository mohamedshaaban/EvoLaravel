<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Booking;
use Illuminate\Http\Request;

class EventbookingDetailsController extends Controller
{
    public function booking($id)
    {
        $eventBooking = Booking::where('event_id', $id)
            ->with('details', 'user', 'event', 'details.groupPrice')->paginate(10);

        return view('vendor.admin.events.booking_detalis', ['booking' => $eventBooking, 'event_id' => $id ,'header' => 'booking']);
    }

    public function attendees(Request $request, $id)
    {
        $eventAttendees = Booking::with(['attendees.ticketType'])
            ->where([
                'event_id' => $id,
                'status' => Booking::STATUS_PAYIED,
            ])->paginate(10);;

        return view('vendor.admin.events.attendee_detalis', ['eventAttendees' => $eventAttendees, 'event_id' => $id ,'header' => 'attendees']);
    }
}
