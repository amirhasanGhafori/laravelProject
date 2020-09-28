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


    public function editChannel(Request $request){
        $request->validate([
            'name'=>['required']
        ]);

        resolve(ChannelRepository::class)->update($request);

        return response()->json([
            'message'=>'channel edited successfully'
        ],Response::HTTP_OK);

    }

    /**
     * @param Request $request
     */


}
