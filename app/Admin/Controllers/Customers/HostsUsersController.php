<?php

namespace App\Admin\Controllers\Customers;

use App\Models\HostsUsers;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\User;
use Encore\Admin\Widgets\Table;
use Illuminate\Http\Request;
use App\Models\Country;

class HostsUsersController extends Controller
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
        $grid = new Grid(new User());
        
        $grid->model()->where('role_id', '=', User::HOST_USER_ROLE_ID)->orderBy('id', 'desc');
        $grid->filter(function ($filter) {
            $filter->in('type' , 'Host users Type')->checkbox([
                User::PROFESSIONAL_USER_TYPE_ID => 'PROFESSIONAL',
                User::GROUP_USER_TYPE_ID => 'GROUP',
                User::COMPANY_USER_TYPE_ID => 'COMPANY',
            ]);

            $filter->like('email', 'user email');
//            $filter->like('host.email', 'host email');
            $filter->in('country_id','Country')->multipleSelect(\App\Models\Country::all()->pluck('name_en', 'id'));
        });

        // $grid->actions(function ($actions) {
        //     // prepend an action.
        //     $actions->prepend('<a href=""><i class="fa fa-paper-plane"></i></a>');
        // });

        $grid->id('ID');
        $grid->email('email')->sortable();
        $grid->column('country_id','Country')->display(function () {
            $user = User::where('id' ,$this->id)->get()->first();
          
            if(!is_null($user)){
            $country = Country::find($user->country_id);
            if($country)
            {
            return '<span>' . $country->name_en . '</span>';
            }
            }
        })->sortable();
        $grid->avatar('avatar')->image(100, 100);

//        $grid->column('role_id')->display(function () {
//            if ($this->role_id == User::HOST_USER_ROLE_ID) {
//                return "<span'>Host User</span>";
//            } elseif ($this->role_id == User::NORMAL_USER_ROLE_ID) {
//                return "<span'>Normal User</span>";
//            }
//        });

        $grid->column('type','host type')->display(function () {
            if ($this->type == User::PROFESSIONAL_USER_TYPE_ID) {
                return "<span'>Profession</span>";
            } elseif ($this->type == User::GROUP_USER_TYPE_ID) {
                return "<span'>Group User</span>";
            } elseif ($this->type == User::COMPANY_USER_TYPE_ID) {
                return "<span'>Company User</span>";
            }
        })->sortable();
        
       
        // $grid->is_active('Is Active');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');

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
        $show = new Show(User::findOrFail($id));

        $show->id('ID');
        $show->email('email');
        $show->avatar('avatar')->image(100, 100);

        $show->column('role_id')->display(function () {
            if ($this->role_id == User::HOST_USER_ROLE_ID) {
                return "<span>Host User</span>";
            } elseif ($this->role_id == User::NORMAL_USER_ROLE_ID) {
                return "<span>Normal Uyser</span>";
            }
        });
        $show->column('host type')->display(function () {
            if ($this->type == User::PROFESSIONAL_USER_TYPE_ID) {
                return "<span>Profession</span>";
            } elseif ($this->type == User::GROUP_USER_TYPE_ID) {
                return "<span>Group User</span>";
            } elseif ($this->type == User::COMPANY_USER_TYPE_ID) {
                return "<span>Company User</span>";
            }
        });
        $show->host(function ($host) {
            $host->email();
            $host->company_name();
            $host->company_certificate();
            $host->landline();
            $host->mobile();
            $host->website();
            $host->work_from();
            $host->work_to();
            $host->break_from();
            $host->break_to();
        });

        $show->profession(function ($profission) {
            $profission->en_name();
        });
        $show->socailmedia('Socail Media', function ($socail) {
            $socail->name();
            $socail->link();
        });

        $show->socailmedia()->pluck('link', 'name')->map('ucwords')->implode('-');
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
        $form = new Form(new User);

        $form->tab('Personal Information', function ($form) {

            $form->text('name')->required();
            $form->text('email')->required();
            $form->password('password')->required()->default(function ($form) {
                return $form->model()->password;
            });;

            $form->saving(function (Form $form) {
                if ($form->password && $form->model()->password != $form->password) {
                    $form->password = bcrypt($form->password);
                }
            });
            $form->hidden('role_id',1);
//            $form->select('role_id')->options([
//                User::HOST_USER_ROLE_ID => 'host',
//                // User::NORMAL_USER_ROLE_ID => 'normal'
//            ])->required();
            $form->select('type')->options([
                User::PROFESSIONAL_USER_TYPE_ID => 'Professional',
                User::GROUP_USER_TYPE_ID => 'Group',
                User::COMPANY_USER_TYPE_ID => 'Company'
            ])->required();
            $form->select('status')->options([
                User::SUSPEND_USER => 'Suspend User',
                User::APPROVED_USER => 'Approved User',
                User::REJECTED_USER => 'Rejcted User'
            ])->required();            
            $form->image('avatar');
            $form->number('number_of_events' , 'Number Of Events');
            $form->number('number_of_activity' , 'Number Of Activity');
            $form->number('number_of_services' , 'Number Of Services');
            $form->multipleSelect('profession')->options(\App\Models\Professions::all()->pluck('en_name', 'id'))->required();
            $form->multipleSelect('packeges')->options(\App\Models\Packages::all()->pluck('name_en', 'id'));
        })
                    ->tab('Socail Media', function ($form) {

                $form->hasMany('socailmedia', function (Form\NestedForm $form) {
                    $form->select('type')->options([
                        1 => 'instgram',
                        2 => 'facebook',
                        3 => 'twitter'
                    ]);
                    $form->text('link');

                });

            })
            ->tab('Profession Certification', function ($form) {

                $form->hasMany('usercertificate', function (Form\NestedForm $form) {
                    $form->text('name');
                    $form->date('from');
                    $form->date('to');
                    $form->file('certificate_file');
                });


            })
            ->tab('Host Data', function ($form) {


                $form->text('host.company_name')->required();
                $form->email('host.email')->required();
                $form->text('host.location')->required();
                $form->text('host.website')->required();
             $form->date('host.starting_year')->required();
                $form->file('host.company_certificate');
                $form->mobile('host.landline')->required();
                $form->mobile('host.mobile')->required();
                $form->mobile('host.whatsapp')->required();
                $form->time('host.work_from')->required();
                $form->time('host.work_to')->required();
                $form->time('host.break_from')->required();
                $form->time('host.break_to')->required();


            })

            ;
        $form->display('created_at');
        $form->display('updated_at');


        return $form;
    }
//    public function update(Request $request)
//    {
//        dump('234');
//        dd($request);
//    }
            
}
