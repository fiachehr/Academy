<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultRoles = [
            ['title'=>'Super Admin','roles'=>['uf','cf','hf','lf','ff','rf','sf']],
            ['title'=>'Secretary','roles'=>['ue','cf','hf','lf','fe','re','sf']],
            ['title'=>'Teacher','roles'=>['ug','cf','hf','lf','fn','rg','sf']],
            ['title'=>'Student','roles'=>['un','cg','hg','lg','fn','rn','sf']]
        ];

        foreach ($defaultRoles as $value) {
            $role = Role::create(['title'=>$value['title'],'ts_register'=>Carbon::now()->timestamp]);
            $roleID = $role->id;
            foreach ($value['roles'] as $item) {
                $role->permissions()->create(['role_id'=>$roleID,'module'=>$item[0],'type'=>$item[1]]);
            }
            if($value['title'] == 'Super Admin') User::create(['role_id'=>$roleID,'name'=>'Administrator','email'=>'fiachehr@gmail.com','password'=>'Administrator12345','ts_register'=>Carbon::now()->timestamp,'is_active'=>1]);
        }
    }
}
