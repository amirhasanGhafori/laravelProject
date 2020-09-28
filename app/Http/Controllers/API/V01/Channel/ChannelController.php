<?php

namespace App\Http\Controllers\API\V01\Channel;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Repositories\ChannelRepository;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function getAllChannelLists(){
        return response()->json(Channel::all(),200);
    }


    public function createNewChannel(Request $request){
        $request->validate([
            'name'=>['required']
        ]);

        resolve(ChannelRepository::class)->create($request);

        return response()->json([
            'message'=>'channel create successfully'
        ],201);

    }

}
