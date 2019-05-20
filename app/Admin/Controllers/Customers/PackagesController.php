<?php

namespace App\Admin\Controllers\Customers;

use App\Models\Packages;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\User;

class PackagesController extends Controller
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
        $grid = new Grid(new Packages);

        $grid->filter(function ($filter) {

            // Remove the default id filter
            $filter->disableIdFilter();
        
            // Add a column filter
            $filter->like('name_ar', 'arabic name');
            $filter->like('name_en', 'english name');
            $filter->scope('is_active', 'active')->where('status', true);
            $filter->scope('not_active', 'not active')->where('status', false);

        });

        $grid->id('ID');
        $grid->name_ar('Arbic name');
        $grid->name_en('English name');
        $grid->logo()->image(100, 100);
        $grid->num_of_events();
        $grid->num_of_activity();
        $grid->num_of_services();
        $grid->duration();
        $grid->price();

        $grid->description();

        $grid->column('status')->display(function () {
            if ($this->status == 0) {
                return "<span style='color: red;'>not active</span>";
            } else {
                return "<span style='color: #00a65a	;'>active</span>";
            }
        });
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
        $show = new Show(Packages::findOrFail($id));

        $show->id('ID');
        $show->name_ar('Arbic name');
        $show->name_en('English name');
        $show->logo()->image(100, 100);
        $show->num_of_events();
        $show->num_of_activity();
        $show->num_of_services();
        $show->duration('Validity in months');
        $show->price();
        $show->description();
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
        $form = new Form(new Packages);

        $form->display('id');

        $form->text('name_en');
        $form->text('name_ar');
        $form->image('logo')->uniqueName();
        $form->number('num_of_events');
        $form->number('num_of_activity');
        $form->number('num_of_services');
        $form->number('duration', 'Validity ( in months ) ');
        $form->text('price');
        $form->textarea('description');
        $states = [
            'on' => ['value' => 1, 'text' => 'Active', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'disactive', 'color' => 'danger'],
        ];
        $form->switch('status')->states($states);
        $form->multipleSelect('user')->options(\App\User::where('role_id', User::HOST_USER_ROLE_ID)->pluck('email', 'id'));


        return $form;
    }
}
