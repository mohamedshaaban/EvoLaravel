<?php

namespace App\Admin\Controllers\Event;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class CategoryController extends Controller
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
        $grid = new Grid(new Category());

	    $grid->filter(function ($filter) {

		    // Remove the default id filter
		    $filter->disableIdFilter();

		    // Add a column filter
		    $filter->like('ar_name', 'Arabic name');
		    $filter->like('en_name', 'English name');
		    $filter->where(function($query){
		    	$query->whereHas('parent', function($hasQuery) {
		    		$hasQuery->where('name_ar', 'like', "%{$this->input}%");
			    });
		    }, 'Arabic name');
		    $filter->where(function($query){
		    	$query->whereHas('parent', function($hasQuery) {
		    		$hasQuery->where('name_en', 'like', "%{$this->input}%");
			    });
		    }, 'English name');
		    $filter->scope('parent_categories', 'Parents')->where('category_id', 0);
		    $filter->scope('sub_categories', 'Sub-Categories')->where('category_id', '!=', '0');

	    });

        $grid->id('ID');

	    $grid->name_ar('Arabic name');
	    $grid->name_en('English name');

	    $grid->column('parent.name_ar', 'Arabic name Parent');
	    $grid->column('parent.name_en', 'English name Parent');

        $grid->created_at('Created at');
        $grid->updated_at('Updated at');

	    $grid->model()->orderBy('category_id');
	    $grid->model()->orderBy('id');

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
        $show = new Show(Category::with('parent')->findOrFail($id));

        $show->id('ID');
	    $show->name_ar('Arabic name');
	    $show->name_en('English name');

	    if(!is_null($show->getModel()->parent)) {
		    $show->parent( 'Parent Category', function ( $parent ) {
			    $parent->id('ID');
			    $parent->name_ar( 'Arabic name' );
			    $parent->name_en( 'English name' );
		    } );
	    }

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
        $form = new Form(new Category);

	    $form->text('name_ar', 'Arabic name');
	    $form->text('name_en', 'English name');

	    $form->select('category_id','Parent')
	         ->options( [0=>"No Parent"] + Category::where('category_id', 0)->get(['name_en', 'id'])->pluck('name_en', 'id')->toArray())
	         ->default('0');

	    return $form;
    }
}
