<?php

namespace App\Admin\Controllers\Professions;

use App\Models\Professions;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ProfessionsController extends Controller
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
        $grid = new Grid(new Professions);

        $grid->filter(function ($filter) {

            // Remove the default id filter
            $filter->disableIdFilter();
        
            // Add a column filter
            $filter->like('ar_name', 'arabic name');
            $filter->like('en_name', 'english name');
            $filter->scope('is_active', 'active')->where('is_active', true);
            $filter->scope('not_active', 'not active')->where('is_active', false);

        });

        $grid->id('ID');
        $grid->ar_name('Arbic name');
        $grid->en_name('English name');
        $grid->column('is_active')->display(function () {
            if ($this->is_active == false) {
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
        $show = new Show(Professions::findOrFail($id));

        $show->id('ID');
        $show->ar_name('arabic name');
        $show->en_name('english name');
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
        $form = new Form(new Professions);

        // $form->display('id');
        $form->text('ar_name', 'Arabic name');
        $form->text('en_name', 'English name');
        $states = [
            'active' => ['value' => true, 'color' => 'success'],
            'not_active' => ['value' => false, 'color' => 'danger'],
        ];
        $form->switch('is_active')->states($states);
        $form->display('created_at');
        $form->display('updated_at');

        return $form;
    }
}
