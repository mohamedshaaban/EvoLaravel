<?php

namespace App\Admin\Controllers\Customers;

use App\Models\Packages;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Models\EasPrice;

class EasPriceController extends Controller
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
        return false;
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
        $grid = new Grid(new EasPrice);

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
        $grid->name_en('English name');
        $grid->name_ar('Arbic name');
        $grid->logo()->image(100, 100);
        $grid->max_amount();
        $grid->number();
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
        $show = new Show(EasPrice::findOrFail($id));

        $show->id('ID');
        $show->name_ar('Arbic name');
        $show->name_en('English name');
        $show->logo()->image(100, 100);
        $show->max_amount();
        $show->number();
        $show->duration();
        $show->price();
        $show->status();
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
        $form = new Form(new EasPrice);

        $form->display('id');

        $form->text('name_ar');
        $form->text('name_en');
        $form->image('logo')->uniqueName();
        $form->number('max_amount');
        $form->number('number');
        $form->number('duration', 'Validity ( in months ) ');
        $form->text('price');
        $form->textarea('description');
        $states = [
            'on' => ['value' => 1, 'text' => 'Active', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'disactive', 'color' => 'danger'],
        ];
        $form->switch('status')->states($states);
     

        return $form;
    }
}
