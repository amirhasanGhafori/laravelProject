<?php

namespace Http\Controllers\API\V01\Channel;

use App\Http\Controllers\API\V01\Channel\ChannelController;
use App\Models\Channel;
use App\Repositories\ChannelRepository;
use Faker\Factory;
use Illuminate\Http\Request;
use Tests\TestCase;

class ChannelControllerTest extends TestCase
{

    public function test_all_channels_list_should_be_accessible()
    {
        $response = $this->get(route('channel.all'));
        $response->assertStatus(500);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

}
