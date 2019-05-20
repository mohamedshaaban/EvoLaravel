<?php

namespace App\Admin\Controllers\Event;

use App\Models\AddedCompany;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\User;
use App\Models\Location;

class LocationController extends Controller
{
	use HasResourceActions;

	/**
	 * Index interface.
	 *
	 * @param Content $content
	 *
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
	 *
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
	 *
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
	 *
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
		$grid = new Grid(new Location);
		$grid->model()->orderBy('id', 'desc');
		$grid->filter(function ($filter) {

			// Remove the default id filter
			$filter->disableIdFilter();

			$filter->like('name_en', 'english name');
			$filter->like('name_ar', 'arabic name');
			$filter->in('status' , 'status')->checkbox([
                1 => 'active',
                0 => 'disactive',
            ]);
			// Add a column filter

		});

		$grid->name_en('name_en');
		$grid->name_ar('name_ar');
		
		$grid->column('status')->display(function () {
			if ($this->status == 1) {
				return "<span>Active</span>";
			} else {
				return "<span>Not Active</span>";
			}
		});
		
		// $grid->status('status');
		// $grid->added_by('added_by');

		$grid->created_at('Created at');

		return $grid;
	}

	/**
	 * Make a show builder.
	 *
	 * @param mixed $id
	 *
	 * @return Show
	 */
	protected function detail($id)
	{
		$show = new Show(Location::findOrFail($id));


		$show->name_en('name en');
		$show->name_ar('name ar');
		
		$show->status('statu');
		

		$show->created_at('Created at');

		return $show;
	}

	/**
	 * Make a form builder.
	 *
	 * @return Form
	 */
	protected function form()
	{
		$form = new Form(new Location);

		$form->text('name_en', 'English name');
		$form->text('name_ar', 'Arabic name');
		
		$states = [
			'on' => ['value' => 1, 'text' => 'Active', 'color' => 'success'],
			'off' => ['value' => 0, 'text' => 'disactive', 'color' => 'danger'],
		];
		$form->switch('status')->states($states);
	
		// $form->text('added_by', 'Added By');

		return $form;
	}
}
