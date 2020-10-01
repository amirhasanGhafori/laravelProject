<?php

namespace Http\Controllers\API\V01\Channel;

use App\Http\Controllers\API\V01\Channel\ChannelController;
use App\Models\Channel;
use Illuminate\Http\Response;
use Tests\TestCase;

class ChannelControllerTest extends TestCase
{

    public function testGetAllChannel()
    {
        $response = $this->get(route('channel.show'));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_create_new_channel()
    {
        $response = $this->postJson(route('channel.create'),[
            'name'=>'Laravel'
        ]);

        $response->assertStatus(Response::HTTP_CREATED);

    }


    public function test_edit_channel()
    {
        $response = $this->postJson(route('channel.edit'),[
            'id'=>1,
            'name'=>'Sass'
        ]);

        $response->assertStatus(Response::HTTP_OK);

    }

    public function test_delete_channel(){

        $response = $this->deleteJson(route('channel.delete'),[
            'id'=>1
        ]);

        $response->assertStatus(Response::HTTP_OK);

    }


}
