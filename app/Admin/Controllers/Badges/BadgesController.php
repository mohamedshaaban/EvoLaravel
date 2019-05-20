<?php

namespace App\Admin\Controllers\Badges;

use App\Models\Country;
use App\User;
use App\Models\Badges;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


use App\Models\HostsUsers;


class BadgesController extends Controller {
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
		$grid = new Grid( new Badges );
		$grid->filter( function ( $filter ) {
			// Remove the default id filter
			$filter->disableIdFilter();
			// Add a column filter
			$filter->like( 'code', 'Code' );
			$filter->like( 'name_en', 'Name En' );
			$filter->like( 'name_ar', 'Name Ar' );

		} );
		$grid->id( 'ID' );
		$grid->code( 'code' );
		$grid->name_en( 'Name En' );
		$grid->name_ar( 'Name Ar' );

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
		$show = new Show( Badges::findOrFail( $id ) );
		$show->id( 'ID' );
		$show->name_en( 'Name En' );
		$show->name_ar( 'Name Ar' );
		$show->code( 'Code' );
//        $show->logo('Logo');
		$show->user_type( 'user_type' )->as( function () {
			switch ( $this->user_type ) {
				case User::NORMAL_USER_ROLE_ID:
					return "Normal Users";
					break;

				case User::HOST_USER_ROLE_ID:
					return "Hosts";
					break;

				case User::ALL_USER_ROLE_ID:
					return "All Users";
			}

			return '';
		} );
		$show->target_gender( 'Target Gender' )->as( function () {
			switch ( $this->target_gender ) {
				case Badges::TARGET_GENDER_FEMALE:
					return "Females";
					break;

				case Badges::TARGET_GENDER_MALE:
					return "Males";
					break;

				case Badges::TARGET_GENDER_ALL:
					return "All";
			}

			return '';
		} );
		$show->badge_type( 'Badge Type' )->as( function () {
			switch ( $this->badge_type ) {
				case Badges::BADGE_TYPE_TRANSACTIONS;
					return "Transactions";
					break;

				case Badges::BADGE_TYPE_EAS:
					return "EAS";
			}

			return '';
		} );
		$show->no_of_transactions_from( '# Transactions From' );
		$show->no_of_transactions_to( '# Transactions To' );
		$show->no_eas_from( '# EAS From' );
		$show->no_eas_to( '# EAS To' );

		$show->include_rating( 'Include Rating?' )->as( function () {
			if ( $this->include_rating ) {
				return "Yes";
			} else {
				return "No";
			}
		} );

		$show->rating_from( 'Rating From' );
		$show->rating_to( 'Rating To' );

		$show->created_at( 'Created at' );
		$show->updated_at( 'Updated at' );

		return $show;
	}

	/**
	 * Make a form builder.
	 *
	 * @return Form
	 */
	protected function form() {

		$form = new Form( new Badges );
		$form->text( 'name_en', 'Name En' )->rules( 'required' )->default(old('name_en'));
		$form->text( 'name_ar', 'Name Ar' )->rules( 'required' )->default(old('name_ar'));
		$form->text( 'code', 'Code' )->rules( 'required' )->default(old('code'));

		$form->select( 'user_type' )->options( [
			User::ALL_USER_ROLE_ID    => 'All Users',
			User::HOST_USER_ROLE_ID   => 'Hosts',
			User::NORMAL_USER_ROLE_ID => 'Normal Users'
		] )->rules( 'required' )->value(old('user_type'));

		$form->select( 'target_gender' )->options( [
			Badges::TARGET_GENDER_ALL    => 'All',
			Badges::TARGET_GENDER_MALE   => 'Males',
			Badges::TARGET_GENDER_FEMALE => 'Females',
		] )->rules( 'required' );


		$form->select( 'badge_type' )->options( [
			Badges::BADGE_TYPE_TRANSACTIONS => 'Transaction',
			Badges::BADGE_TYPE_EAS          => 'EAS'
		] )->rules( 'required' );


		$form->file( 'logo', 'Badge Logo' )->rules( 'required' );
		$form->text( 'no_of_transactions_from', 'no_of_transactions_from' )->rules( 'required_if:badge_type,'.Badges::BADGE_TYPE_TRANSACTIONS );
		$form->text( 'no_of_transactions_to', 'no_of_transactions_to' )->rules( 'required_if:badge_type,'.Badges::BADGE_TYPE_TRANSACTIONS );
		$form->text( 'no_eas_from', 'no_eas_from' )->rules( 'required_if:badge_type,'.Badges::BADGE_TYPE_EAS);
		$form->text( 'no_eas_to', 'no_eas_to' )->rules( 'required_if:badge_type,'.Badges::BADGE_TYPE_EAS);
		$states = [
			'active'     => [ 'value' => 1, 'color' => 'success' ],
			'not_active' => [ 'value' => 0, 'color' => 'danger' ],
		];

		$form->switch( 'include_rating' )->states( $states );
		$form->text( 'rating_from', 'rating_from' )->rules( 'required_if:include_rating,1');
		$form->text( 'rating_to', 'rating_to' )->rules( 'required_if:include_rating,1');


		return $form;
	}
}
