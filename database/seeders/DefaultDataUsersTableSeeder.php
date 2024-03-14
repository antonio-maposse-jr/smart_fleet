<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DefaultDataUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default All Permission
        $allPermission = [
            [
                'name' => 'manage user',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create user',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit user',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete user',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage contact',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create contact',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit contact',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete contact',
                'guard_name' => 'web',
            ],

            [
                'name' => 'manage note',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create note',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit note',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete note',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage logged history',
                'guard_name' => 'web',

            ],
            [
                'name' => 'delete logged history',
                'guard_name' => 'web',

            ],
            [
                'name' => 'manage pricing packages',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create pricing packages',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit pricing packages',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete pricing packages',
                'guard_name' => 'web',
            ],
            [
                'name' => 'buy pricing packages',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage coupon',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create coupon',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit coupon',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete coupon',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage coupon history',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete coupon history',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage pricing transation',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage account settings',
                'guard_name' => 'web',

            ],
            [
                'name' => 'manage password settings',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage general settings',
                'guard_name' => 'web',

            ],
            [
                'name' => 'manage company settings',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage email settings',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage payment settings',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage seo settings',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage google recaptcha settings',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage client',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create client',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit client',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete client',
                'guard_name' => 'web',
            ],
            [
                'name' => 'show client',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage driver',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create driver',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit driver',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete driver',
                'guard_name' => 'web',
            ],
            [
                'name' => 'show driver',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage vehicle type',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create vehicle type',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit vehicle type',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete vehicle type',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage vehicle',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create vehicle',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit vehicle',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete vehicle',
                'guard_name' => 'web',
            ],
            [
                'name' => 'show vehicle',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage inspection',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create inspection',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit inspection',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete inspection',
                'guard_name' => 'web',
            ],
            [
                'name' => 'show inspection',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage inspection type',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create inspection type',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit inspection type',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete inspection type',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage booking',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create booking',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit booking',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete booking',
                'guard_name' => 'web',
            ],
            [
                'name' => 'show booking',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage service',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create service',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit service',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete service',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage fuel',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create fuel',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit fuel',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete fuel',
                'guard_name' => 'web',
            ],
            [
                'name' => 'show fuel',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage expense',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create expense',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit expense',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete expense',
                'guard_name' => 'web',
            ],
        ];
        Permission::insert($allPermission);

        // Default Super Admin Role
        $superAdminRoleData=  [
            'name' => 'super admin',
        ];
        $systemSuperAdminRole = Role::create($superAdminRoleData);
        $systemSuperAdminPermission = [
            ['name' => 'manage user'],
            ['name' => 'create user'],
            ['name' => 'edit user'],
            ['name' => 'delete user'],
            ['name' => 'manage contact'],
            ['name' => 'create contact'],
            ['name' => 'edit contact'],
            ['name' => 'delete contact'],
            ['name' => 'manage note'],
            ['name' => 'create note'],
            ['name' => 'edit note'],
            ['name' => 'delete note'],
            ['name' => 'manage pricing packages'],
            ['name' => 'create pricing packages'],
            ['name' => 'edit pricing packages'],
            ['name' => 'delete pricing packages'],
            ['name' => 'manage pricing transation'],
            ['name' => 'manage coupon'],
            ['name' => 'create coupon'],
            ['name' => 'edit coupon'],
            ['name' => 'delete coupon'],
            ['name' => 'manage coupon history'],
            ['name' => 'delete coupon history'],
            ['name' => 'manage account settings'],
            ['name' => 'manage password settings'],
            ['name' => 'manage general settings'],
            ['name' => 'manage email settings'],
            ['name' => 'manage payment settings'],
            ['name' => 'manage seo settings'],
            ['name' => 'manage google recaptcha settings'],

        ];
        $systemSuperAdminRole->givePermissionTo($systemSuperAdminPermission);
        // Default Super Admin
        $superAdminData=     [
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('123456'),
            'type' => 'super admin',
            'lang' => 'english',
            'profile' => 'avatar.png',
            'parent_id' => 0,
        ];
        $systemSuperAdmin = User::create($superAdminData);
        $systemSuperAdmin->assignRole($systemSuperAdminRole);

        // Default Owner Role
        $ownerRoleData=  [
            'name' => 'owner',
            'parent_id' => $systemSuperAdmin->id,
        ];
        $systemOwnerRole = Role::create($ownerRoleData);

        // Default Owner All Permissions
        $systemOwnerPermission = [
            ['name' => 'manage user'],
            ['name' => 'create user'],
            ['name' => 'edit user'],
            ['name' => 'delete user'],
            ['name' => 'manage role'],
            ['name' => 'create role'],
            ['name' => 'edit role'],
            ['name' => 'delete role'],
            ['name' => 'manage contact'],
            ['name' => 'create contact'],
            ['name' => 'edit contact'],
            ['name' => 'delete contact'],
            ['name' => 'manage note'],
            ['name' => 'create note'],
            ['name' => 'edit note'],
            ['name' => 'delete note'],
            ['name' => 'manage logged history'],
            ['name' => 'delete logged history'],
            ['name' => 'manage pricing packages'],
            ['name' => 'buy pricing packages'],
            ['name' => 'manage pricing transation'],
            ['name' => 'manage account settings'],
            ['name' => 'manage account settings'],
            ['name' => 'manage password settings'],
            ['name' => 'manage general settings'],
            ['name' => 'manage company settings'],
            ['name' => 'manage client'],
            ['name' => 'create client'],
            ['name' => 'edit client'],
            ['name' => 'delete client'],
            ['name' => 'show client'],
            ['name' => 'manage driver'],
            ['name' => 'create driver'],
            ['name' => 'edit driver'],
            ['name' => 'delete driver'],
            ['name' => 'show driver'],
            ['name' => 'manage vehicle type'],
            ['name' => 'create vehicle type'],
            ['name' => 'edit vehicle type'],
            ['name' => 'delete vehicle type'],
            ['name' => 'manage vehicle'],
            ['name' => 'create vehicle'],
            ['name' => 'edit vehicle'],
            ['name' => 'delete vehicle'],
            ['name' => 'show vehicle'],
            ['name' => 'manage inspection'],
            ['name' => 'create inspection'],
            ['name' => 'edit inspection'],
            ['name' => 'delete inspection'],
            ['name' => 'show inspection'],
            ['name' => 'manage inspection type'],
            ['name' => 'create inspection type'],
            ['name' => 'edit inspection type'],
            ['name' => 'delete inspection type'],
            ['name' => 'manage booking'],
            ['name' => 'create booking'],
            ['name' => 'edit booking'],
            ['name' => 'delete booking'],
            ['name' => 'show booking'],
            ['name' => 'manage service'],
            ['name' => 'create service'],
            ['name' => 'edit service'],
            ['name' => 'delete service'],
            ['name' => 'manage fuel'],
            ['name' => 'create fuel'],
            ['name' => 'edit fuel'],
            ['name' => 'delete fuel'],
            ['name' => 'show fuel'],
            ['name' => 'manage expense'],
            ['name' => 'create expense'],
            ['name' => 'edit expense'],
            ['name' => 'delete expense'],

        ];
        $systemOwnerRole->givePermissionTo($systemOwnerPermission);

        // Default Owner Create
        $ownerData=     [
            'name' => 'Owner',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('123456'),
            'type' => 'owner',
            'lang' => 'english',
            'profile' => 'avatar.png',
            'subscription' => 1,
            'parent_id' => $systemSuperAdmin->id,
        ];
        $systemOwner = User::create($ownerData);
        // Default Owner Role Assign
        $systemOwner->assignRole($systemOwnerRole);


        // Default Owner Role
        $managerRoleData=    [
            'name' => 'manager',
            'parent_id' => $systemOwner->id,
        ];
        $systemManagerRole = Role::create($managerRoleData);

        // Default Manager All Permissions
        $systemManagerPermission = [
            ['name' => 'manage user'],
            ['name' => 'create user'],
            ['name' => 'edit user'],
            ['name' => 'delete user'],
            ['name' => 'manage contact'],
            ['name' => 'create contact'],
            ['name' => 'edit contact'],
            ['name' => 'delete contact'],
            ['name' => 'manage note'],
            ['name' => 'create note'],
            ['name' => 'edit note'],
            ['name' => 'delete note'],
            ['name' => 'manage client'],
            ['name' => 'create client'],
            ['name' => 'edit client'],
            ['name' => 'delete client'],
            ['name' => 'show client'],
            ['name' => 'manage driver'],
            ['name' => 'create driver'],
            ['name' => 'edit driver'],
            ['name' => 'delete driver'],
            ['name' => 'show driver'],
            ['name' => 'manage vehicle type'],
            ['name' => 'create vehicle type'],
            ['name' => 'edit vehicle type'],
            ['name' => 'delete vehicle type'],
            ['name' => 'manage vehicle'],
            ['name' => 'create vehicle'],
            ['name' => 'edit vehicle'],
            ['name' => 'delete vehicle'],
            ['name' => 'show vehicle'],
            ['name' => 'manage inspection'],
            ['name' => 'create inspection'],
            ['name' => 'edit inspection'],
            ['name' => 'delete inspection'],
            ['name' => 'show inspection'],
            ['name' => 'manage inspection type'],
            ['name' => 'create inspection type'],
            ['name' => 'edit inspection type'],
            ['name' => 'delete inspection type'],
            ['name' => 'manage booking'],
            ['name' => 'create booking'],
            ['name' => 'edit booking'],
            ['name' => 'delete booking'],
            ['name' => 'show booking'],
            ['name' => 'manage service'],
            ['name' => 'create service'],
            ['name' => 'edit service'],
            ['name' => 'delete service'],
            ['name' => 'manage fuel'],
            ['name' => 'create fuel'],
            ['name' => 'edit fuel'],
            ['name' => 'delete fuel'],
            ['name' => 'show fuel'],
            ['name' => 'manage expense'],
            ['name' => 'create expense'],
            ['name' => 'edit expense'],
            ['name' => 'delete expense'],
        ];
        $systemManagerRole->givePermissionTo($systemManagerPermission);
        // Default Manager Create
        $managerData=   [
            'name' => 'Manager',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('123456'),
            'type' => 'manager',
            'lang' => 'english',
            'profile' => 'avatar.png',
            'subscription' => 0,
            'parent_id' => $systemOwner->id,
        ];
        $systemManager = User::create($managerData);
        // Default Manager Role Assign
        $systemManager->assignRole($systemManagerRole);


        // Default Client Role
        $clientRoleData=   [
            'name' => 'client',
            'parent_id' => $systemOwner->id,
        ];
        $systemClientRole = Role::create($clientRoleData );
        // Default Client All Permissions
        $systemClientPermission = [
            ['name' => 'manage contact'],
            ['name' => 'create contact'],
            ['name' => 'edit contact'],
            ['name' => 'delete contact'],
            ['name' => 'manage note'],
            ['name' => 'create note'],
            ['name' => 'edit note'],
            ['name' => 'delete note'],
        ];
        $systemClientRole->givePermissionTo($systemClientPermission);


        // Default Driver Role
        $driverRoleData= [
            'name' => 'driver',
            'parent_id' => $systemOwner->id,
        ];
        $systemDriverRole = Role::create($driverRoleData);
        // Default Client All Permissions
        $systemDriverPermission = [
            ['name' => 'manage contact'],
            ['name' => 'create contact'],
            ['name' => 'edit contact'],
            ['name' => 'delete contact'],
            ['name' => 'manage note'],
            ['name' => 'create note'],
            ['name' => 'edit note'],
            ['name' => 'delete note'],
        ];
        $systemDriverRole->givePermissionTo($systemDriverPermission);

        // Subscription default data
        $subscriptionData=[
            'title' => 'Basic',
            'package_amount' => 0,
            'interval' => 'Unlimited',
            'user_limit' => 5,
            'client_limit' => 5,
            'driver_limit' => 5,
            'enabled_logged_history' => 1 ,
        ];
        \App\Models\Subscription::create($subscriptionData );
    }
}
