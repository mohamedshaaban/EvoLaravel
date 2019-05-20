<?php

namespace App\Admin\Controllers\Notifications;

use App\Models\SendNotification;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\User;
use App\Mail\SendNotifications;

class SendNotificationController extends Controller
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
            ->description('Social Media')
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
        $grid = new Grid(new SendNotification);
        $grid->model()->orderBy('id', 'desc');

        $grid->filter(function ($filter) {

		    // Remove the default id filter
            $filter->disableIdFilter();

		    // Add a column filter
           #


        });

        $grid->id('ID');

        $grid->column('notification_type')->display(function () {
            if ($this->notification_type == SendNotification::TYPE_EMAIL) {
                return "<span>Email</span>";
            } elseif ($this->notification_type == SendNotification::TYPE_MOBILE) {
                return "<span>Mobile</span>";
            } elseif ($this->notification_type == SendNotification::TYPE_BOTH) {
                return "<span>Both</span>";
            }
        });

        $grid->column('user_type')->display(function () {
            if ($this->user_type == User::ALL_USER_ROLE_ID) {
                return "<span>All Users</span>";
            } elseif ($this->user_type == User::HOST_USER_ROLE_ID) {
                return "<span>Host Users</span>";
            } elseif ($this->user_type == User::NORMAL_USER_ROLE_ID) {
                return "<span>Normal Users</span>";
            }
        });
        $grid->subject();
        $grid->message();
        $grid->description();
        $grid->column('status')->display(function () {
            if ($this->status == 1) {
                return "<span style='color:green;'>Success</span>";
            } else {
                return "<span style='color:red;'>failed</span>";
            }
        });
        // $grid->status();

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
        $show = new Show(SendNotification::findOrFail($id));

        $show->id('ID');

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
        $form = new Form(new SendNotification);

        $form->select('notification_type')->options([
            SendNotification::TYPE_EMAIL => 'Email',
            SendNotification::TYPE_MOBILE => 'Mobile',
            SendNotification::TYPE_BOTH => 'Both'
        ])->rules('required');

        $form->select('user_type')->options([
            User::ALL_USER_ROLE_ID => 'All Users',
            User::HOST_USER_ROLE_ID => 'Host Users',
            User::NORMAL_USER_ROLE_ID => 'Normal Users'
        ])->rules('required');

        $form->text('subject');
        $form->ckeditor('message');
        $form->textarea('description');
        $form->hidden('status');

        $form->saving(function (Form $form) {

            switch ($form->user_type) {
                case User::ALL_USER_ROLE_ID:
                    $users = User::all();
                    break;
                case User::HOST_USER_ROLE_ID:
                    $users = User::where('role_id', User::HOST_USER_ROLE_ID)->get();
                    break;
                case User::NORMAL_USER_ROLE_ID:
                    $users = User::where('role_id', User::NORMAL_USER_ROLE_ID)->get();
                    break;
            }
            $data = [
                'message' => $form->message,
                'subject' => $form->subject,
                'description' => $form->description,
            ];


            switch ($form->notification_type) {
                case SendNotification::TYPE_EMAIL:
                    foreach ($users as $user) {
                        retry(5, function () use ($user, $data) {
                            Mail::to($user->email)->queue(new SendNotifications($user, $data));
                        }, 100);
                    }
                    $form->status = 1;
                    break;
                case SendNotification::TYPE_MOBILE:
                    dd('Mobile Notification not working yet');
                    break;
                case SendNotification::TYPE_BOTH:
                    foreach ($users as $user) {
                        retry(5, function () use ($user, $data) {
                            Mail::to($user->email)->queue(new SendNotifications($user, $data));
                        }, 100);
                    }
                    dd('Email was sended but mobile notifiaction not working yet');
                    break;
            }

        });



        return $form;
    }
}
