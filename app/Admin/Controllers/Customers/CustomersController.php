<?php

namespace App\Admin\Controllers\Customers;

use App\Models\Country;

use App\User;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\customers;

use App\Models\HostsUsers;



class CustomersController extends Controller
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
            ->body($this->grid());
    }
//    public function store(Request $request)
//    {
//        $data = $request->all();
//        $avator = null;
//
//        if ($request->hasFile('avatar')) {
//            $file = $request->file('avatar');
//            $avator = time() . $file->getClientOriginalName();
//            $path = public_path() . '/storage/users/';
//            $file->move($path, $avator);
//        }
//        $user = User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'avatar' => $avator,
//            'password' => Hash::make($data['password']),
//            'role_id' => User::NORMAL_USER_ROLE_ID,
//            'verification_token' => User::generateVerificationCode(),
//        ]);
//
//
//
//        $customerData['user_id'] = $user->id;
//        $customerData['full_name'] = $data['full_name'];
//        $customerData['date_of_birth'] = $data['date_of_birth'];
//        $customerData['is_active'] = 1;
//        $customerData['gender'] = $data['gender'];
//        $customerData['country_id'] = $data['country_id'];
//        $customerData['description'] = $data['description'];
//        customers::create($customerData);
//
//        return redirect(route('customers.index'));
//    }
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
        $grid = new Grid(new User);
        $grid->model()->where('role_id',2)->orderBy('id', 'desc');
        $grid->filter(function ($filter) {
            // Remove the default id filter
            $filter->disableIdFilter();
            // Add a column filter
            $filter->like('customers.full_name', 'full name');
            $filter->in('customers.gender' , 'gender')->checkbox([
                'm' => 'male',
                'f' => 'female',
            ]);
            $filter->between('customers.date_of_birth' , 'Date Of Birth')->date();
            
        });
        $grid->id('ID');
        $grid->name();
         $grid->column('Full name')->display(function () {
             
            $custmer = customers::where('user_id' ,$this->id)->first();
            if(($custmer)){
            return '<span>' . $custmer->full_name . '</span>';
        }
        });
      
        $grid->customers()->gender();
        $grid->customers()->date_of_birth();
        $grid->email();
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
        $show->full_name('full name');
        $show->description('Description');
        $show->date_of_birth('Date of Birth');
        $show->is_active('active')->as(function ($is_active) {
            if ($is_active == false) {
                return "not active";
            } else {
                return "active";
            }
        });
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

        $form = new Form( new User);
        $form->tab('Personal Information', function ($form) {

            $form->text('name')->rules('required');
            $form->text('email')->rules('required');
            $form->password('password');
            $form->hidden('role_id')->value(User::NORMAL_USER_ROLE_ID);
            $form->image('avatar');

        })
            ->tab('Customer Data', function ($form) {

                $form->text('customers.full_name')->rules('required');
                $form->date('customers.date_of_birth')->rules('required');

                // $form->date('host.starting_year')->rules('required');
                $form->text('customers.description');


                $form->select('customers.country_id','Country')->options( Country::all()->pluck('name_en', 'id') )->rules('required');
                $states = ['active' => ['value' => true, 'color' => 'success'],
            'not_active' => ['value' => false, 'color' => 'danger'],
        ];
        $genders =['m'=>'male','f'=>'female'];
        $form->switch('customers.is_active')->states($states)->rules('required');
        $form->select('customers.gender','Gender')->options($genders)->rules('required');
            })
            ->tab('Socail Media', function ($form) {

                $form->hasMany('socailmedia', function (Form\NestedForm $form) {
                    $form->select('type')->options([
                        1 => 'instgram',
                        2 => 'facebook',
                        3 => 'twitter'
                    ])->rules('required');
                    $form->url('link')->rules('required');

                });

            });









        return $form;
    }
}
