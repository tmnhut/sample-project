<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=PermissionTableSeeder
     * @return void
     */
    public function run()
    {
        $permissions=[
            [
                'name' => 'role-read',
                'display_name' => 'Display Role Listing',
                'description' => 'See only Listing Of Role'
            ],
            [
                'name' => 'role-create',
                'display_name' => 'Create Role',
                'description' => 'Create New Role'
            ],
            [
                'name' => 'role-edit',
                'display_name' => 'Edit Role',
                'description' => 'Edit Role'
            ],
            [
                'name' => 'role-delete',
                'display_name' => 'Delete Role',
                'description' => 'Delete Role'
            ],
            [
                'name' => 'widget-list',
                'display_name' => 'Display widget Listing',
                'description' => 'See only Listing Of widget'
            ],
            [
                'name' => 'widget-create',
                'display_name' => 'Create widget',
                'description' => 'Create New widget'
            ],
            [
                'name' => 'widget-edit',
                'display_name' => 'Edit widget',
                'description' => 'Edit widget'
            ],
            [
                'name' => 'widget-delete',
                'display_name' => 'Delete widget',
                'description' => 'Delete widget'
            ]
        ];
        foreach ($permissions as $key=>$value){
            Permission::create($value);
        }
    }
}
