<?php

namespace App\Admin\Controllers\Sales;

use App\User;
use App\Models\BalanceTransaction;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Models\Packages;
use App\Models\EasPrice;
use App\Models\Event;

class PackageTransactionController extends Controller
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
        $content
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
        $grid = new Grid(new BalanceTransaction);
        $grid->model()->orderBy('id', 'desc');

        // $grid->model()->whereHas('balanceTransaction');

        $grid->filter(function ($filter) {
            $filter->between('created_at', 'Created Time')->datetime();
            $filter->in('user_id' , 'Users')->multipleSelect(\App\User::all()->pluck('email', 'id'));
            $filter->in('user.role_id' , 'User Role')->checkbox([
                User::HOST_USER_ROLE_ID => 'HOST',
                User::NORMAL_USER_ROLE_ID => 'USER',
            ]);
            $filter->in('user.type' , 'Host users Type')->checkbox([
                User::PROFESSIONAL_USER_TYPE_ID => 'PROFESSIONAL',
                User::GROUP_USER_TYPE_ID => 'GROUP',
                User::COMPANY_USER_TYPE_ID => 'COMPANY',
            ]);
            $filter->in('use_eas_id' , 'EAS')->multipleSelect(\App\Models\EasPrice::all()->pluck('name_en', 'id'));

            $filter->in('user.country_id')->multipleSelect(\App\Models\Country::all()->pluck('name_en', 'id'));

            // $filter->in('packagesTransaction.role_id' , 'role_id')->multipleSelect(\App\User::all()->pluck('email', 'id'));
            
            // Remove the default id filter
            // Add a column filter
        });

        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
        });

        $grid->id('Transaction id');
        // $grid->user()->email('Email');

        $grid->column('user')->display(function () {
            $user = User::find($this->user_id);
            return '<span><a href="/admin/users/hosts/' . $user->id . '/edit' . '">' . $user->email . '</a></span>';
        });
        $grid->column('type')->display(function () {
            if (!is_null($this->user_package_id)) {
                $package = Packages::find($this->user_package_id);
                return '<span><a href="/admin/users/packages/' . $package->id . '/edit' . '">' . "package /" . $package->name_en . '</a></span>';
            } else {
                $easPrice = EasPrice::find($this->use_eas_id);
                
            }
        });

        // $grid->package()->name_en('Pakage name');
        $grid->purchase_date('Purchase date');
        $grid->duration_date('Duration date');
        $grid->number_of_events('Number of events');
        $grid->number_of_activity('Number of activity');
        $grid->number_of_services('Number of services');
        $grid->total('Total');
        $grid->created_at('Transaction date');

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
        $show = new Show(BalanceTransaction::findOrFail($id));

        $show->id('ID');


        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new BalanceTransaction);

        // $form->display('id');
        $form->select('user_id', 'user_id')->options(\App\User::all()->pluck('email', 'id'));
        $form->select('user_package_id', 'user_package_id')->options(Packages::all()->pluck('name_en', 'id'));
        $form->select('use_eas_id', 'use_eas_id')->options(EasPrice::all()->pluck('name_en', 'id'));

        $form->text('purchase_date', 'Purchase date');
        $form->text('duration_date', 'Duration_date');
        $form->text('number_of_events', 'Number of events');
        $form->text('number_of_activity', 'Number of activity');
        $form->text('number_of_services', 'Number of services');
        $form->text('total', 'Total');
        $form->display('created_at');
        $form->display('updated_at');

        return $form;
    }
}
