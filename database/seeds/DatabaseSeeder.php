<?php

use Illuminate\Database\Seeder;
use App\Models\Professions;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$sqls = [];

	    $sqls[] = <<<SQL
	    INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `created_at`, `updated_at`) VALUES
    (1, 0, 1, 'Index', 'fa-bar-chart', '/', NULL, NULL),
(2, 0, 2, 'Admin', 'fa-tasks', '', NULL, NULL),
(3, 2, 3, 'Users', 'fa-users', 'auth/users', NULL, NULL),
(4, 2, 4, 'Roles', 'fa-user', 'auth/roles', NULL, NULL),
(5, 2, 5, 'Permission', 'fa-ban', 'auth/permissions', NULL, NULL),
(6, 2, 6, 'Menu', 'fa-bars', 'auth/menu', NULL, NULL),
(7, 2, 7, 'Operation log', 'fa-history', 'auth/logs', NULL, NULL),
(8, 0, 7, 'Helpers', 'fa-gears', '', '2018-09-25 03:06:11', '2018-09-25 03:06:11'),
(9, 8, 8, 'Scaffold', 'fa-keyboard-o', 'helpers/scaffold', '2018-09-25 03:06:12', '2018-09-25 03:06:12'),
(10, 8, 9, 'Database terminal', 'fa-database', 'helpers/terminal/database', '2018-09-25 03:06:12', '2018-09-25 03:06:12'),
(11, 8, 10, 'Laravel artisan', 'fa-terminal', 'helpers/terminal/artisan', '2018-09-25 03:06:13', '2018-09-25 03:06:13'),
(12, 8, 11, 'Routes', 'fa-list-alt', 'helpers/routes', '2018-09-25 03:06:13', '2018-09-25 03:06:13'),
(13, 0, 12, 'Media manager', 'fa-file', 'media', '2018-09-25 03:07:20', '2018-09-25 03:07:20'),
(14, 0, 0, 'professions', 'fa-bars', 'professions', '2018-09-25 03:52:15', '2018-09-25 03:52:15');
SQL;

	    $sqls[] = <<<SQL
INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `http_method`, `http_path`, `created_at`, `updated_at`) VALUES
    (1, 'All permission', '*', '', '*', NULL, NULL),
(2, 'Dashboard', 'dashboard', 'GET', '/', NULL, NULL),
(3, 'Login', 'auth.login', '', '/auth/login\r\n/auth/logout', NULL, NULL),
(4, 'User setting', 'auth.setting', 'GET,PUT', '/auth/setting', NULL, NULL),
(5, 'Auth management', 'auth.management', '', '/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs', NULL, NULL),
(6, 'Admin helpers', 'ext.helpers', NULL, '/helpers/*', '2018-09-25 03:06:14', '2018-09-25 03:06:14'),
(7, 'Media manager', 'ext.media-manager', NULL, '/media*', '2018-09-25 03:07:20', '2018-09-25 03:07:20');
SQL;

	    $sqls[] = <<<SQL
INSERT INTO `admin_roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
    (1, 'Administrator', 'administrator', '2018-09-25 03:02:55', '2018-09-25 03:02:55');
SQL;

	    $sqls[] = <<<SQL
INSERT INTO `admin_role_menu` (`role_id`, `menu_id`, `created_at`, `updated_at`) VALUES
    (1, 2, NULL, NULL),
(1, 14, NULL, NULL);
SQL;

	    $sqls[] = <<<SQL
INSERT INTO `admin_role_permissions` (`role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
    (1, 1, NULL, NULL);
SQL;

	    $sqls[] = <<<SQL
INSERT INTO `admin_role_users` (`role_id`, `user_id`, `created_at`, `updated_at`) VALUES
    (1, 1, NULL, NULL);
SQL;

	    $sqls[] = <<<'SQL'
INSERT INTO `admin_users` (`id`, `username`, `password`, `name`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
    (1, 'admin', '$2y$10$Eg403gu5tDGokfx/l2VBTeXvMhdA9UpWRp3UbaNrCSFF18WWkdUh2', 'Administrator', NULL, NULL, '2018-09-25 03:02:52', '2018-09-25 03:02:52');
SQL;

    	foreach ($sqls as $sql){
		    db::insert($sql);
	    }

        $this->call(CountriesTableSeeder::class);


	    $this->call(CountriesTableSeeder::class);
	    $this->call(CitySeeder::class);

	    $this->call(UserSeeder::class);

	    $this->call(CategorySeeder::class);
	    $this->call(MainTypeSeeder::class);
	    $this->call(RequireDataSeeder::class);

	    $this->call(AddedCompanySeeder::class);
	    $this->call(AddedProfessionalSeeder::class);
	    $this->call(AddedSponsorSeeder::class);
	    $this->call(AddressTypeSeeder::class);
	    $this->call(EventSeeder::class);

	    // Professions
//         Professions::truncate();
        $professionQuantity = 100;
        factory(Professions::class, $professionQuantity)->create();
    }
}
