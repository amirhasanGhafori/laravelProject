<?php

namespace App\Http\Controllers\API\V01\Channel;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Repositories\ChannelRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ChannelController extends Controller
{
    public function getAllChannel()
    {
        return response()->json(Channel::all(),Response::HTTP_OK);
    }

    public function createNewChannel(Request $request){
        $request->validate([
            'name'=>['required']
        ]);

        resolve(ChannelRepository::class)->create($request);

        return \response()->json([
            'message'=>'create Channel Successfully'
        ],Response::HTTP_CREATED);

    }

}
