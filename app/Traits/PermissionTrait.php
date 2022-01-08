<?php

namespace App\Traits;

use App\Models\Page;
use App\Models\User;

trait PermissionTrait
{
    private function getPermission($user_id){

        $selectedColumns = [
            'users.id as user_id',
            'users.permission_version',

            'modules.id as module_id',
            'modules.name as module_name',
            'modules.sequence as module_sequence',

            'sub_modules.id as sub_module_id',
            'sub_modules.name as sub_module_name',
            'sub_modules.sequence as sub_module_sequence',

            'pages.id as page_id',
            'pages.name as page_name',
            'pages.route_name as page_route_name',
            'pages.is_landing_page',
        ];

        $permissions = User::query()
            ->select($selectedColumns)
            ->where('users.id', $user_id)
            ->join('user_roles', 'user_roles.user_id', '=', 'users.id')
            ->join('role_pages', 'role_pages.role_id', '=', 'user_roles.role_id')
            ->join('pages', 'pages.id', '=', 'role_pages.page_id')
            ->join('sub_modules', 'sub_modules.id', '=', 'pages.sub_module_id')
            ->join('modules', 'modules.id', '=', 'pages.module_id')
            ->get()
            ->unique('page_id')
        ;
        $this->assignSession($permissions);



    }

    private function assignSession($permissions){

        $sidebarArr = [];
        $routeList = [];

        foreach ($permissions as $permission){
            $routeList[] = $permission['page_route_name'];
            if ($permission['is_landing_page'] == Page::IS_LANDING_PAGE){

                $sidebarArr[$permission['module_id']]['module_name'] = $permission['module_name'];
                $sidebarArr[$permission['module_id']]['module_sequence'] = $permission['module_sequence'];
                $sidebarArr[$permission['module_id']]['sub_modules'][] = [
                    'sub_module_name' => $permission['sub_module_name'],
                    'route_name' => $permission['page_route_name'],
                    'sub_module_sequence' => $permission['sub_module_sequence']
                ];
                usort($sidebarArr[$permission['module_id']]['sub_modules'], function ($item1, $item2) {
                    return $item1['sub_module_sequence'] <=> $item2['sub_module_sequence'];
                });

            }
        }

        usort($sidebarArr, function ($item1, $item2) {
            return $item1['module_sequence'] <=> $item2['module_sequence'];
        });


        session()->put('side_bar_array', $sidebarArr);
        session()->put('permitted_route_list', $routeList);
        session()->put('permission_version', $permissions[0]->permission_version);





    }

}
