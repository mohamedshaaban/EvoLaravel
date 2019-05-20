<?php

namespace App\Admin\Controllers\World;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

use App\Models\Country;
class CountryController extends Controller
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
        $grid = new Grid(new Country);

        $grid->filter(function ($filter) {

		    // Remove the default id filter
            $filter->disableIdFilter();

		    // Add a column filter
            $filter->like('name_ar', 'Arabic name');
            $filter->like('name_en', 'English name');


        });

        $grid->id('ID');
        $grid->name_ar('Arabic name');
        $grid->name_en('English name');
        $grid->code('code');
        // $grid->created_at('Created at');
        // $grid->updated_at('Updated at');

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
        $show = new Show(Country::findOrFail($id));

        $show->id('ID');
        $show->name_ar('Arabic name');
        $show->name_en('English name');
        $show->code('Code');
        // $show->created_at('Created at');
        // $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Country);

        $form->text('name_ar', 'Arabic name');
        $form->text('name_en', 'English name');
        $form->text('code', 'Code');
        $states = [
            'off' => ['value' => 0, 'text' => 'disabled', 'color' => 'danger'],
            'on' => ['value' => 1, 'text' => 'enabled', 'color' => 'success'],

        ];
        $form->switch('status', 'status')->states($states);
        return $form;
    }
}
