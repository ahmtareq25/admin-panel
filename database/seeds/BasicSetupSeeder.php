<?php

use App\Models\Module;
use App\Models\Role;
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

            Module::create([
                'id' => 1000,
                'name' => 'Access Control'
            ]);


            $subModuleRows = [
                ['id' => 2000, 'module_id' => 1000, 'name' => 'User Management'],
                ['id' => 2001, 'module_id' => 1000, 'name' => 'Role Management'],
                ['id' => 2002, 'module_id' => 1000, 'name' => 'Page Management'],
                ['id' => 2003, 'module_id' => 1000, 'name' => 'Role & Page Association'],
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


            DB::commit();
        } catch (\Exception $exception) {
            \Illuminate\Support\Facades\DB::rollBack();
        }


    }
}
