<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Collapse;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Tab;
use Encore\Admin\Widgets\Table;
use Encore\Admin\Widgets\Callout;

use App\User;
use App\Models\Event;
use App\Models\MainType;
use App\Models\HostsUsers;
use App\Models\Category;
use App\Models\Booking;
use App\Models\BalanceTransaction;
use Carbon\Carbon;



class HomeController extends Controller
{

    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Dashboard');
            $content->description('Description...');

            $content->row(function ($row) {
                $row->column(3, new InfoBox('Users', 'users', 'aqua', '/admin/users/hosts', \App\User::all()->count()));
                // $row->column(3, new InfoBox('Customers', 'users', 'red', '/admin/customers', \App\User::where('role_id', User::NORMAL_USER_ROLE_ID)->count()));
                $row->column(3, new InfoBox('Events', 'book', 'green', '/admin/event/event_details', Event::all()->count()));
                $row->column(3, new InfoBox('Sales', 'shopping-cart', 'yellow', '/admin/event/event_details', Booking::all()->sum('total')));
                $row->column(3, new InfoBox('Packages sales', 'shopping-basket', 'red', '/admin/sales/packages', BalanceTransaction::all()->sum('total')));
            });

            $content->row(function (Row $row) {
                // users chart
                $count_professional_users = User::where('type', User::PROFESSIONAL_USER_TYPE_ID)
                    ->where('role_id', User::HOST_USER_ROLE_ID)->get()->count();
                $count_company_users = User::where('type', User::COMPANY_USER_TYPE_ID)
                    ->where('role_id', User::HOST_USER_ROLE_ID)->get()->count();
                $count_group_users = User::where('type', User::GROUP_USER_TYPE_ID)
                    ->where('role_id', User::HOST_USER_ROLE_ID)->get()->count();
                $count_normal_users = User::where('role_id', User::NORMAL_USER_ROLE_ID)->get()->count();

                $users_count = [
                    'professional' => $count_professional_users,
                    'company' => $count_company_users,
                    'group' => $count_group_users,
                    'customer' => $count_normal_users
                ];

                $bar1 = view('admin.chartjs.doughnut', ['users_count' => $users_count]);
                $row->column(2 / 4, new Box('User', $bar1));

                // event chart

                $count_event_type = Event::where('type', Event::TYPE_EVENT)->get()->count();
                $count_activity_type = Event::where('type', Event::TYPE_ACTIVITY)->get()->count();
                $count_service_type = Event::where('type', Event::TYPE_SERVICE)->get()->count();
                $events_count = [
                    'events' => $count_event_type,
                    'activity' => $count_activity_type,
                    'service' => $count_service_type,

                ];

                $bar = view('admin.chartjs.bar', ['events_count' => $events_count]);
                $row->column(2 / 6, new Box('Events', $bar));






            });

            $headers = ['Id', 'type', 'Main type', 'host user', 'title', 'category', 'age', 'date', 'time', 'capacity'];
            $rows = [];
            foreach (Event::whereIn('type', [1, 2, 3])->whereDate('date_from', '>=', Carbon::now()->format('Y-m-d'))->orderBy('date_from', 'asc')
                ->limit(10)->get() as $event) {
                switch ($event->type) {
                    case Event::TYPE_EVENT:
                        $type = 'Event';
                        break;
                    case Event::TYPE_ACTIVITY:
                        $type = 'ACTIVITY';
                        break;
                    case Event::TYPE_SERVICE:
                        $type = 'SERVICE';
                        break;

                }
                $rows[] = [
                    $event->id,
                    $type,
                    MainType::find($event->main_type_id)->name_en,
                    optional(HostsUsers::find($event->host_id))->email,
                    $event->title_en,
                    Category::find($event->category_id)->name_en,
                    $event->age_from . '-' . $event->age_to,
                    $event->date_from . '-' . $event->date_to,
                    $event->time_from . '-' . $event->time_to,
                    $event->capacity,
                ];
            }

            $content->row((new Box('Coming soon events', new Table($headers, $rows)))->style('info')->solid());
        });
    }
}
