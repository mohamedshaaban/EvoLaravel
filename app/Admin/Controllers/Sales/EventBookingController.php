<?php

namespace App\Admin\Controllers\Sales;

use App\User;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Models\Event;
use App\Models\HostsUsers;
use App\Models\Booking;
use App\Models\Country;

class EventBookingController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Event);
        

        $grid->model()->has('booking')->orderBy('id', 'desc');
        
        $grid->filter(function ($filter) {
            
            // Remove the default id filter
            // Add a column filter
            $filter->disableIdFilter();
            $filter->like('id', 'Event Id');
            $filter->in('booking.user_id'    , 'Users')->multipleSelect(\App\User::all()->pluck('email', 'id'));
            $filter->where(function ($query) {
                
            $input = $this->input;
                $users = User::where('country_id',$input)->get();
                $eventsID = array();
                foreach($users as $user)
                {
                   if($user->host)
                   {
                   $events = Event::where('host_id',$user->host->id)->get();
                   if($events)
                   {
                    foreach($events as $host)
                    {
                        $eventsID[]=$host->id;
                    }
                   }
                   }
                    
                }
                
                $query->wherein('id', $eventsID);
                
            }, 'Countries')->select(\App\Models\Country::all()->pluck('name_en', 'id'));

            $filter->like('host.email', 'Host email');
//            $filter->in('country_id' , 'Countries')->select(\App\Models\Country::all()->pluck('name_en', 'id'));

        });


        $grid->actions(function ($actions) {
            $event = Event::find($actions->getKey());
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
            $actions->prepend('<a href="/admin/event_booking/' . $actions->getKey() . '"' . '><i class="fa fa-paper-plane"></i> '.$event->booking->count().'</a>');
            $actions->prepend('<a href="/admin/event_attendee/' . $actions->getKey() . '"' . '><i class="fa fa-user"></i> '.$event->attendes->count().' </a>');
           
            
        });

        $grid->column('EAS')->display(function () {
            $event = Event::find($this->id);
            $type = 'E - ';
            if($event->type == 2)
            {
                 $type = 'A - ';
            }
            else if($event->type == 3 ) 
            {
                $type = 'S - ';
            }
            return '<span><a href="/admin/event/event_details/' . $this->id . '/edit' . '">'.$type.' ' . $event->title_en . '</a></span>';
        });
        $grid->column('Type')->display(function () {
            $event = Event::find($this->id);
            $type = 'Event  ';
            if($event->type == 2)
            {
                 $type = 'Activity ';
            }
            else if($event->type == 3 ) 
            {
                $type = 'Service ';
            }
            return '<span>'.$type.' </span>';
        });
        $grid->column('host name')->display(function () {
            $host = HostsUsers::where('id' ,$this->host_id)->get()->first();
            if(!is_null($host)){
            return '<span><a href="/admin/users/hosts/' . $host->id . '/edit' . '">' . $host->company_name . '</a></span>';
        }
        });
        $grid->column('country')->display(function () {
            $host = HostsUsers::where('id' ,$this->host_id)->get()->first();
            if(!is_null($host)){
            $country = Country::find($host->user->country_id);
            return '<span>' . $country->name_en . '</span>';
            }
        });
        $grid->capacity('capacity');

        $grid->column('total booking')->display(function () {
            $booking_count = Booking::where('event_id', $this->id)->count();
            return "<span>" . $booking_count . "</span>";
        });

        $grid->column('total payment')->display(function () {
            $booking_sum = Booking::where('event_id', $this->id)->sum('total');
            return "<span>" . $booking_sum . "</span>";
        });

        $grid->column('date_from')->display(function () {
            return "<span>" . $this->date_from . "-" . $this->date_to . "</span>";
        });

        // $grid->created_at(' Transaction date ');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Event::findOrFail($id));

        $show->id(' ID ');


        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Event);

        // $form->display(' id ');

        $form->display(' created_at ');
        $form->display(' updated_at');

        return $form;
    }
}
