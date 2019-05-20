<?php

namespace App\Admin\Controllers\Event;

use App\Models\Event;
use App\Models\City;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Models\MainType;

class EventDetailsController extends Controller
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
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        
        if($event->type == 1)
        {
            $event->host->user->number_of_events+=1;
        }
        else if($event->type == 2)
        {
            $event->host->user->number_of_activity+=1;
        }
        else 
        {
            $event->host->user->number_of_services+=1;
        }
          
       $event->host->user->update();
        $event->delete();
        return response()->json([
        'status'  => true,
        'message' => 'success',
        ]);
        dd($id);
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        $grid = new Grid(new Event);
        $grid->model()->orderBy('id', 'desc');
        $grid->actions(function ($actions) {
            // $actions->disableDelete();
            // $actions->disableEdit();
            $actions->disableView();
        });
        $grid->filter(function ($filter) {

		    // Remove the default id filter
            // $filter->disableIdFilter();

            $filter->lt('capacity', "capacity");
            $filter->gt('capacity', "capacity");
            $filter->equal('host_id')->select(\App\User::where('role_id', \App\User::HOST_USER_ROLE_ID)->pluck('name', 'id'));

            $filter->in('gender')->checkbox([
                Event::GENDER_MALE => 'MALE',
                Event::GENDER_FEMALE => 'FEMALE',
                Event::GENDER_BOTH => 'BOTH',
            ]);

            $filter->in('type')->checkbox([
                Event::TYPE_ACTIVITY => 'ACTIVITY',
                Event::TYPE_EVENT => 'EVENT',
                Event::TYPE_SERVICE => 'SERVICE',
            ]);
            // $form->select('category_id', 'category')->options(\App\Models\Category::all()->pluck('name_en', 'id'));

            $filter->in('category_id')->multipleSelect(\App\Models\Category::all()->pluck('name_en', 'id'));
            $filter->between('age_from', 'Age from');
            $filter->between('age_to', 'Age to');

            
            // $filter->in('category')->checkbox([
            //     Event::GENDER_MALE    => 'MALE',
            //     Event::GENDER_FEMALE    => 'FEMALE',
            //     Event::GENDER_BOTH    => 'BOTH',
            // ]);
           		    // Add a column filter
            // $filter->scope('a-type', 'ACTIVITY')->where('type', Event::TYPE_ACTIVITY);
            // $filter->scope('e-type', 'EVENT')->where('type', Event::TYPE_EVENT);
            // $filter->scope('s-type', 'SERVICE')->where('type', Event::TYPE_SERVICE);
          
            // $filter->scope('m-gender', 'MALE')->where('gender', Event::GENDER_MALE);
            // $filter->scope('f-gender', 'FEMALE')->where('gender', Event::GENDER_FEMALE);
            // $filter->scope('b-gender', 'BOTH')->where('gender', Event::GENDER_BOTH);

        });

        $grid->id('ID');

        $grid->column('type')->display(function () {
            if ($this->type == Event::TYPE_EVENT) {
                return "<span'>Event</span>";
            } elseif ($this->type == Event::TYPE_ACTIVITY) {
                return "<span'>Activity</span>";
            } elseif ($this->type == Event::TYPE_SERVICE) {
                return "<span'>Service</span>";
            }
        });



        $grid->title_en('Title');
        $grid->category()->name_en('Category');

        $grid->column('Gender')->display(function () {
            if ($this->gender == Event::GENDER_MALE) {
                return "<span'>Male</span>";
            } elseif ($this->gender == Event::GENDER_FEMALE) {
                return "<span'>Female</span>";
            } elseif ($this->gender == Event::GENDER_BOTH) {
                return "<span'>Both</span>";
            }
        });

        $grid->location_name_en('Location');
        $grid->column('position')->openMap(function () {
            return [$this->address_lat, $this->address_long];
        }, 'Position');
        $grid->capacity('Capacity');
        $grid->booking_per_user('Booking');
        $grid->column('Age')->display(function () {
            return "<span'>" . $this->age_from . "-" . $this->age_to . "</span>";
        });
        $grid->column('Date')->display(function () {
            return "<span'>" . $this->date_from . "-" . $this->date_to . "</span>";
        });
        $grid->column('Time')->display(function () {
            return "<span'>" . $this->time_from . "-" . $this->time_to . "</span>";
        });

        $grid->column('Break')->display(function () {
            return "<span'>" . $this->break_from . "-" . $this->break_to . "</span>";
        });


        $grid->column('Canceled')->display(function () {
	        $link = route('admin.canceled_ticket', $this->id);

            return
"<a class=\"btn btn-xs btn-default grid-open-map\" href='{$link}'>
    <i class=\"fa fa-user\"> View</i>
</a>";
        });
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

        $show->id('ID');
        $show->host_id('host');
        $show->title_en('title_en');
        $show->title_ar('title_ar');
        $show->description_en('description_en');
        $show->description_ar('description_ar');
        $show->category_id('category_id');
        $show->age_from('age_from');
        $show->age_to('age_to');
        $show->age_to('age_to');

        $show->date_from('date_from');
        $show->date_to('date_to');
        $show->time_from('time_from');
        $show->time_to('time_to');
        $show->location_name_en('location_name_en');
        $show->location_name_ar('location_name_ar');
        $show->address_lat('address_lat');
        $show->address_long('address_long');
        $show->address_text('address_text');
        $show->address_type('address_type');
        $show->address_city('address_city');
        $show->address_block('address_block');
        $show->address_street('address_street');
        $show->address_avenue('address_avenue');
        $show->address_building('address_building');
        $show->address_floor('address_floor');
        $show->private_event('private_event');
        $show->cancellation('cancellation');
        $show->cancellation_days('cancellation_days');
        $show->capacity('capacity');
        $show->fee('fee');



        $show->multi_price('multi_price');
        $show->group_price('group_price');
        $show->published_at('published_at');
        $show->created_at('created_at');
        $show->updated_at('updated_at');
        $show->break_from('break_from');
        $show->break_to('break_to');
        $show->gender('gender');
        $show->attendees_listing('attendees_listing');
        $show->seating_booking_type('seating_booking_type');
        $show->booking_per_user('booking_per_user');
        $show->qr_code('qr_code');
        $show->featured('featured');
        $show->main('main');

        $show->created_at('Created at');
        $show->updated_at('Updated at');

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

        // $form->text('host_id')->rules('required');
        $form->select('host_id', 'hostsusers')
            ->options(\App\User::all()->pluck('email', 'id'));

        $form->select('type')->options([
            Event::TYPE_EVENT => 'Event',
            Event::TYPE_ACTIVITY => 'Activity',
            Event::TYPE_SERVICE => 'Service',

        ])->rules('required');

        $form->select('main_type_id', 'maintype')
            ->options(MainType::all()->pluck('name_en', 'id'));

        // $form->text('main_type_id')->rules('required');

        $form->text('title_en')->rules('required');
        $form->text('title_ar')->rules('required');
        $form->textarea('description_en')->rules('required');
        $form->textarea('description_ar')->rules('required');
        $form->select('category_id', 'category')->options(\App\Models\Category::all()->pluck('name_en', 'id'));
        // $form->text('category_id')->rules('required');
        $form->number('age_from')->rules('required');
        $form->number('age_to')->rules('required');
        $form->date('date_from')->rules('required');
        $form->time('date_to')->rules('required');
        $form->time('time_from')->rules('required');
        $form->time('time_to')->rules('required');
        // $form->map('29.38232269999999', '47.98864419999995', 'map')->useGoogleMap();
        // $form->map($this->address_lat, $this->address_long,)

        $form->text('address_lat')->rules('required');
        $form->text('address_long')->rules('required');
        $form->text('address_text')->rules('required');
        $form->select('address_type', 'AddressType')
            ->options(\App\Models\AddressType::all()->pluck('name_en', 'id'));
        $form->select('address_city', 'city')
            ->options(\App\Models\City::all()->pluck('name_en', 'id'));
        $form->text('address_block');
        $form->text('address_street')->rules('required');
        $form->text('address_avenue');
        $form->text('address_building')->rules('required');
        $form->text('address_floor')->rules('required');
        $states = [
            'on' => ['value' => 1, 'text' => 'private', 'color' => 'danger'],
            'off' => ['value' => 0, 'text' => 'public', 'color' => 'success'],
        ];
        $form->switch('private_event')->states($states);
        $form->text('location_name_ar');
        $form->text('location_name_en');
        $states = [
            'on' => ['value' => 1, 'text' => 'yes', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'no', 'color' => 'danger'],
        ];
        $form->switch('cancellation')->states($states);
        // $form->text('cancellation')->rules('required');
        $form->number('cancellation_days')->rules('required');
        $form->number('capacity')->rules('required');
        $form->number('fee')->rules('required');
        $form->text('multi_price')->rules('required');
        $form->text('group_price')->rules('required');
        $form->date('published_at')->rules('required');
        // $form->date('created_at')->rules('required');
        // $form->date('updated_at')->rules('required');
        $form->time('break_from')->rules('required');
        $form->time('break_to')->rules('required');

        $form->select('gender')->options([
            Event::GENDER_MALE => 'Male',
            Event::GENDER_FEMALE => 'Female',
            Event::GENDER_BOTH => 'Both',
        ])->rules('required');

        $form->multipleSelect('sponsor')->options(\App\Models\AddedSponsor::all()->pluck('name_en', 'id'));
        $form->multipleSelect('company')->options(\App\Models\AddedCompany::all()->pluck('name_en', 'id'));
        $form->multipleSelect('professional')->options(\App\Models\AddedProfessional::all()->pluck('name_en', 'id'));

        $form->text('attendees_listing')->rules('required');

        $form->select('seating_booking_type')->options([
            Event::SEATING_BOOKING_TYPE_ASSIGNED => 'Assiged',
            Event::SEATING_BOOKING_TYPE_RANDOM => 'Random',

        ])->rules('required');
        $form->image('media.link');
        $form->number('booking_per_user');
        $form->text('qr_code');
        $form->radio('featured')->options(["1" => 'yes', "0" => 'No'])->default(0);
        $form->radio('main')->options(["1" => 'yes', "0" => 'No'])->default(0);

        return $form;
    }
}
