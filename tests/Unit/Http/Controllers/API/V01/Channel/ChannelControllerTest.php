<?php

namespace Http\Controllers\API\V01\Channel;

use App\Http\Controllers\API\V01\Channel\ChannelController;
use App\Models\Channel;
use App\Repositories\ChannelRepository;
use Faker\Factory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ChannelControllerTest extends TestCase
{


    public function test_all_channels_list_should_be_accessible()
    {
        $response = $this->get(route('channel.all'));
        $response->assertStatus(Response::HTTP_OK);
    }



    public function test_create_channel(){

        $response = $this->postJson(route('channel.create'),[
            'name'=>'laravel'
        ]);

        return $response->assertStatus(Response::HTTP_CREATED);

    }

}
