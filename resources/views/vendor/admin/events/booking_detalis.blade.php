@extends('admin::index') 
@section('content')
<section class="content-header">
    <h1>
        <span> Event ({{ $event_id }}) Booking Details </span>
    </h1>
</section>

<section class="content">
    @include('admin::partials.alerts')
    @include('admin::partials.exception')
    @include('admin::partials.toastr')

    <div class="box">
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        
                        <th>user email</th>
                        <th>mobile</th>
                        <th>total</th>
                        <th>payment_type</th>
                        <th>
                            booking details
                        </th>

                    </tr>
                </thead>

                <tbody>
                    @foreach($booking as $userBook)
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td><a href="mailto:{{$userBook->email}}">{{$userBook->email}}</a></td>
                        <td>{{$userBook->mobile}}</td>
                        <td>{{$userBook->total}}</td>
                        <td>
                            @if( $userBook->payment_type == App\Models\Booking::PAYMENT_TYPE_KNET)
                            <img src="{{ asset('images/kent_card.jpg')}}" alt="Knet"> 
                            @elseif($userBook->payment_type == App\Models\Booking::PAYMENT_TYPE_MASTER)
                            <img src="{{ asset('images/master_card.jpg') }}" alt="Master">
                            @else
                            <img src="{{ asset('images/visa_card.jpg') }}" alt="Visa">
                            @endif
                        </td>
                        {{--
                        <td>{{$userBook->status}}</td> --}}
                        <td>
                             <a href="{{ route('admin.booking_attendees' ,[$userBook->event_id ,'booking_id' => $userBook->id ])}}"> 
                            @foreach($userBook->details as $eventDetails)
                            <br /> {{(isset($eventDetails->groupPrice) ? 'group price (' . $eventDetails->groupPrice->name_en . ')' : '')   }} quantity  ({{ $eventDetails->quantity }}) : total {{ $eventDetails->total_price}}
                             @endforeach
                             </a> 
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <div class="box-footer clearfix">
                 {{ $booking->links() }} 
        </div>
        <!-- /.box-body -->
    </div>


</section>
@endsection