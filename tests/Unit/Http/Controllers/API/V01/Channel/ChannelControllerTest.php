<?php

namespace Http\Controllers\API\V01\Channel;

use App\Http\Controllers\API\V01\Channel\ChannelController;
use App\Models\Channel;
use App\Models\User;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ChannelControllerTest extends TestCase
{
    public function registerRolesAndPermissions()
    {
        $roleInDatabase = Role::where('name',config('permission.default_rules')[0]);
        if ($roleInDatabase)
        {
            foreach (config('permission.default_rules') as $role){
                Role::create([
                    'name'=>$role
                ]);
            }//foreach
        }//if

        $permissionInDatabase = Permission::where('name',config('permission.default_permission')[0]);
        if ($permissionInDatabase)
        {
            foreach (config('permission.default_permission') as $permission){
                Permission::create([
                    'name'=>$permission
                ]);
            }
        }//if

    }

    public function testGetAllChannel()
    {
        $response = $this->get(route('channel.show'));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_create_new_channel()
    {

        $this->registerRolesAndPermissions();
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $user->givePermissionTo('channel management','user management');
        $response = $this->postJson(route('channel.create'),[
            'name'=>'Laravel'
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }


    public function test_edit_channel()
    {

        $user = User::factory()->create();
        $user->givePermissionTo('channel management','user management');

        Sanctum::actingAs($user);
        $response = $this->postJson(route('channel.edit'),[
            'id'=>1,
            'name'=>'Sass'
        ]);

        $response->assertStatus(Response::HTTP_OK);

    }

    public function test_delete_channel(){

        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $user->givePermissionTo('channel management','user management');

        $response = $this->deleteJson(route('channel.delete'),[
            'id'=>1
        ]);

        $response->assertStatus(Response::HTTP_OK);

    }


}
