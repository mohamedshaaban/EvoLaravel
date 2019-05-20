<?php

namespace App\Admin\Controllers\Settings;

use App\Models\Setting;
use App\Models\Currency;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class SettingController extends Controller
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
            ->description('Social Media')
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
        $grid = new Grid(new Setting);

        $grid->actions(function ($actions) {
            $actions->disableDelete();
            // $actions->disableEdit();
            // $actions->disableView();
        });

        $grid->filter(function ($filter) {
		    // Remove the default id filter
            // $filter->disableIdFilter();
        });

        // $grid->id('ID');

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
        $show = new Show(Setting::findOrFail($id));

        $show->id('ID');
        $show->logo('logo');
        $show->facebook('facebook');
        $show->twitter('twitter');
        $show->instgram('instgram');
        $show->linkedin('linkedin');
        $show->whatsapp('whatsapp');
        $show->google_store_link('google_store_link');
        $show->app_store_link('app_store_link');
        $show->copy_right_ar('copy_right_ar');
        $show->copy_right_en('copy_right_en');
        $show->address_ar('address_ar');
        $show->address_en('address_en');
        $show->phone('phone');
        $show->mobile('mobile');
        $show->email_support('email_support');
        $show->email_info('email_info');
        $show->default_currency('default_currency');
        $show->working_hours('working_hours');
        $show->location('location');
        $show->commission('commission');
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Setting);

        $form->image('logo');
        $form->url('facebook');
        $form->url('twitter');
        $form->url('instgram');
        $form->url('linkedin');
        $form->text('whatsapp');
        $form->url('google_store_link');
        $form->url('app_store_link');
        $form->text('copy_right_ar');
        $form->text('copy_right_en');
        $form->text('address_ar');
        $form->text('address_en');
        $form->mobile('phone');
        $form->mobile('mobile');
        $form->email('email_support');
        $form->email('email_info');
        $form->select('default_currency')
            ->options(Currency::where('status', 1)->get(['name_en', 'code'])->pluck('name_en', 'code')->toArray());
	         
        // $show->('default_currency');
        $form->text('working_hours');
        $form->text('location');
        $form->number('commission' , 'commission %');



        return $form;
    }
}
