<?php

namespace App\Admin\Controllers\Event;

use App\Models\MainType;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class MainTypeController extends Controller {
	use HasResourceActions;

	/**
	 * Index interface.
	 *
	 * @param Content $content
	 *
	 * @return Content
	 */
	public function index( Content $content ) {
		return $content
			->header( 'Index' )
			->description( 'description' )
			->body( $this->grid() );
	}

	/**
	 * Show interface.
	 *
	 * @param mixed $id
	 * @param Content $content
	 *
	 * @return Content
	 */
	public function show( $id, Content $content ) {
		return $content
			->header( 'Detail' )
			->description( 'description' )
			->body( $this->detail( $id ) );
	}

	/**
	 * Edit interface.
	 *
	 * @param mixed $id
	 * @param Content $content
	 *
	 * @return Content
	 */
	public function edit( $id, Content $content ) {
		return $content
			->header( 'Edit' )
			->description( 'description' )
			->body( $this->form()->edit( $id ) );
	}

	/**
	 * Create interface.
	 *
	 * @param Content $content
	 *
	 * @return Content
	 */
	public function create( Content $content ) {
		return $content
			->header( 'Create' )
			->description( 'description' )
			->body( $this->form() );
	}

	/**
	 * Make a grid builder.
	 *
	 * @return Grid
	 */
	protected function grid() {
		$grid = new Grid( new MainType );
		$grid->filter(function ($filter) {

			// Remove the default id filter
			$filter->disableIdFilter();

			// Add a column filter
			$filter->like('ar_name', 'Arabic name');
			$filter->like('en_name', 'English name');
			$filter->scope('event', 'Event')->where('event_type', MainType::EVENT_TYPE_EVENT);
			$filter->scope('activity', 'Activity')->where('event_type', MainType::EVENT_TYPE_ACTIVITY);
			$filter->scope('service', 'Service')->where('event_type', MainType::EVENT_TYPE_SERVICE);

		});

		$grid->id( 'ID' );

		$grid->name_ar('Arabic name');
		$grid->name_en('English name');
		$grid->column( 'Event Type')->display(function () {
			switch ( $this->event_type ) {
				case MainType::EVENT_TYPE_EVENT:
					return "Event";
					break;

				case MainType::EVENT_TYPE_ACTIVITY:
					return "Activity";
					break;

				case MainType::EVENT_TYPE_SERVICE:
					return "Service";
			}

			return '';
		});

		$grid->created_at( 'Created at' );

		return $grid;
	}

	/**
	 * Make a show builder.
	 *
	 * @param mixed $id
	 *
	 * @return Show
	 */
	protected function detail( $id ) {
		$show = new Show( MainType::findOrFail( $id ) );

		$show->id( 'ID' );
		$show->name_ar( 'Arabic name' );
		$show->name_en( 'English name' );
		$show->event_type( 'Event Type')->as(function () {
			switch ( $this->event_type ) {
				case MainType::EVENT_TYPE_EVENT:
					return "Event";
					break;

				case MainType::EVENT_TYPE_ACTIVITY:
					return "Activity";
					break;

				case MainType::EVENT_TYPE_SERVICE:
					return "Service";
			}

			return '';
		});
		$show->created_at( 'Created at' );

		return $show;
	}

	/**
	 * Make a form builder.
	 *
	 * @return Form
	 */
	protected function form() {
		$form = new Form( new MainType );

		$form->text( 'name_ar', 'Arabic name' );
		$form->text( 'name_en', 'English name' );

		$form->select( 'event_type', 'Event Type' )
		     ->options( [
			     MainType::EVENT_TYPE_EVENT    => "Event",
			     MainType::EVENT_TYPE_ACTIVITY => "Activity",
			     MainType::EVENT_TYPE_SERVICE  => "Service",
		     ] )
		     ->default( '1' );

		return $form;
	}
}
