<?php

namespace App\Admin\Controllers\Pages;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Models\Faq;

class FaqsController extends Controller
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
        $grid = new Grid(new Faq);

        $grid->filter(function ($filter) {

		    // Remove the default id filter
            $filter->disableIdFilter();

		    // Add a column filter
        });

        $grid->id('ID');
        $grid->question_en('question english');
        $grid->column('status')->display(function () {
            if ($this->status == 1) {
                return "<span style='color:green;'>Active</span>";
            } else {
                return "<span style='color:red;'>Not active</span>";
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
        $show = new Show(Faq::findOrFail($id));

        $show->id('ID');

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
        $form = new Form(new Faq);

        $form->textarea('question_ar', 'Question Arabic');
        $form->textarea('question_en', 'Question English')->rules('required');
        $form->ckeditor('answer_ar', 'Answer Arabic');
        $form->ckeditor('answer_en', 'Answer English')->rules('required');
        $form->select('status')->options([
            1 => 'Active',
            0 => 'Not active'
        ]);


        return $form;
    }
}
