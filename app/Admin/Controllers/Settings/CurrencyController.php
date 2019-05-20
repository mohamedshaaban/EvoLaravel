<?php

namespace App\Admin\Controllers\Settings;

use App\Models\Currency;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Models\Country;

class CurrencyController extends Controller
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
        $grid = new Grid(new Currency);

        $grid->filter(function ($filter) {

		    // Remove the default id filter
            $filter->disableIdFilter();

		    // Add a column filter
            $filter->like('name_ar', 'Arabic name');
            $filter->like('name_en', 'English name');


        });

        $grid->id('ID');
        $grid->code('code');
        $grid->name_ar('Arabic name');
        $grid->name_en('English name');
        $grid->symbol('symbol');
        $grid->value('value');
        $grid->country()->name_en('country');
        $grid->column('status')->display(function () {
            if ($this->status == 0) {
                return "<span style='color: red;'>Disabled</span>";
            } else {
                return "<span style='color: #00a65a	;'>active</span>";
            }
        });

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
        $show = new Show(Currency::findOrFail($id));

        $show->id('ID');
        $show->code('Code');
        $show->name_ar('Arabic name');
        $show->name_en('English name');
        $show->symbol('symbol');
        $show->value('value');
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
       
        $form = new Form(new Currency);

        $form->text('name_ar', 'Arabic name');
        $form->text('name_en', 'English name');
        $form->text('symbol', 'symbol');
        $form->text('value', 'value');
      
        $codes = $this->getCurrenciesCodes();

        $form->select('code')->options($codes)->rules('required');;
        $form->select('country_id')->options(\App\Models\Country::all()->pluck('name_en', 'id'))->rules('required');
        $form->select('status')->options([
            1 => 'ACtive',
            0 => 'Disabled',

        ])->rules('required');

        return $form;
    }

    public function getCurrenciesCodes()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://restcountries.eu/rest/v2/all",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
    	// Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response);
        }

        $codes = [];
        foreach ($response as $value) {
            $codes[$value->currencies[0]->code] = $value->currencies[0]->code;
        }

        return $codes;
    }
}
