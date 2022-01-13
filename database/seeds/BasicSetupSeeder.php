<?php

use App\Models\Module;
use App\Models\Page;
use App\Models\Role;
use App\Models\RolePage;
use App\Models\SubModule;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class BasicSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        try {
            DB::beginTransaction();

            $moduleRow = [
                [
                    'id' => 1000,
                    'name' => 'Access Control',
                    'sequence' => 1,
                ],
                [
                    'id' => 1001,
                    'name' => 'Configuration',
                    'sequence' => 2,
                ]
            ];

            Module::insert($moduleRow);


            $subModuleRows = [
                ['id' => 2000, 'module_id' => 1000, 'name' => 'User Management', 'sequence' => 1],
                ['id' => 2001, 'module_id' => 1000, 'name' => 'Role Management', 'sequence' => 2],
                ['id' => 2002, 'module_id' => 1000, 'name' => 'Role & Page Association', 'sequence' => 3],

                ['id' => 2003, 'module_id' => 1001, 'name' => 'System Settings', 'sequence' => 1],

            ];
            SubModule::insert($subModuleRows);


            User::create([
                'id' => 1,
                'name' => 'A.H.M Tareq',
                'email' => 'ahmtareq05@gmail.com',
                'phone_number' => '008801670339401',
                'password' => Hash::make('12345678'),
                'permission_version' => 0,
                'parent_user_id' => 1,
            ]);

            Role::create([
                'id' => 1,
                'name' => 'ADMIN_ROLE'
            ]);

            UserRole::create([
                'user_id' => 1,
                'role_id' => 1
            ]);

            $pageRows = [
                ['id' => 1, 'module_id' => 1000, 'sub_module_id' => 2000, 'name' => 'User Landing', 'route_name' => config('routename.USER_LANDING'), 'is_landing_page' => 1],
                ['id' => 2, 'module_id' => 1000, 'sub_module_id' => 2000, 'name' => 'User Add', 'route_name' => config('routename.USER_ADD'), 'is_landing_page' => 0],
                ['id' => 3, 'module_id' => 1000, 'sub_module_id' => 2000, 'name' => 'User Edit', 'route_name' => config('routename.USER_EDIT'), 'is_landing_page' => 0],
                ['id' => 4, 'module_id' => 1000, 'sub_module_id' => 2000, 'name' => 'User Delete', 'route_name' => config('routename.USER_DELETE'), 'is_landing_page' => 0],

                ['id' => 5, 'module_id' => 1000, 'sub_module_id' => 2001, 'name' => 'Role Landing', 'route_name' => config('routename.ROLE_LANDING'), 'is_landing_page' => 1],
                ['id' => 6, 'module_id' => 1000, 'sub_module_id' => 2001, 'name' => 'Role Add', 'route_name' => config('routename.ROLE_ADD'), 'is_landing_page' => 0],
                ['id' => 7, 'module_id' => 1000, 'sub_module_id' => 2001, 'name' => 'Role Edit', 'route_name' => config('routename.ROLE_EDIT'), 'is_landing_page' => 0],
                ['id' => 8, 'module_id' => 1000, 'sub_module_id' => 2001, 'name' => 'Role Delete', 'route_name' => config('routename.ROLE_DELETE'), 'is_landing_page' => 0],

                ['id' => 9, 'module_id' => 1000, 'sub_module_id' => 2002, 'name' => 'Role & Page Association Landing', 'route_name' => config('routename.ROLE_AND_PAGE_ASSOCIATION_LANDING'), 'is_landing_page' => 1],
                ['id' => 10, 'module_id' => 1000, 'sub_module_id' => 2002, 'name' => 'Role & Page Association Update', 'route_name' => config('routename.ROLE_AND_PAGE_ASSOCIATION_UPDATE'), 'is_landing_page' => 0],

                ['id' => 11, 'module_id' => 1001, 'sub_module_id' => 2003, 'name' => 'System Settings Landing', 'route_name' => config('routename.SYSTEM_SETTING_LANDING'), 'is_landing_page' => 1],
                ['id' => 12, 'module_id' => 1001, 'sub_module_id' => 2003, 'name' => 'System Settings Update', 'route_name' => config('routename.SYSTEM_SETTING_UPDATE'), 'is_landing_page' => 0],

            ];

            Page::insert($pageRows);

            $rolePage = [
                ['role_id' => 1, 'page_id' => 1],
                ['role_id' => 1, 'page_id' => 2],
                ['role_id' => 1, 'page_id' => 3],
                ['role_id' => 1, 'page_id' => 4],
                ['role_id' => 1, 'page_id' => 5],
                ['role_id' => 1, 'page_id' => 6],
                ['role_id' => 1, 'page_id' => 7],
                ['role_id' => 1, 'page_id' => 8],
                ['role_id' => 1, 'page_id' => 9],
                ['role_id' => 1, 'page_id' => 10],
                ['role_id' => 1, 'page_id' => 11],
                ['role_id' => 1, 'page_id' => 12],
            ];

            RolePage::insert($rolePage);


            DB::commit();
        } catch (\Exception $exception) {
            $logData = [
                'action' => 'Migration Exception',
                'message' => $exception->getMessage()
            ];
            createLog($logData);

            DB::rollBack();
        }


    }
}
