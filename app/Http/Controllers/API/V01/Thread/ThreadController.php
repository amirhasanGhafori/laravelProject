<?php

namespace App\Http\Controllers\API\V01\Thread;

use App\Http\Controllers\Controller;
use App\Models\Thread;
use App\Repositories\ThreadRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class ThreadController extends Controller
{
    public function index()
    {
        $threads = resolve(ThreadRepository::class)->getAllAvailableThreads();
        return response()->json($threads,Response::HTTP_OK);
    }

    public function show($slug)
    {
        $threads = resolve(ThreadRepository::class)->getThreads($slug);
        return \response()->json($threads,Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>['required'],
            'content'=>['required'],
            'channel_id'=>['required']
        ]);

        resolve(ThreadRepository::class)->storeThread($request);
        return \response()->json([
            'message'=>'thread create successfully'
        ],Response::HTTP_CREATED);
    }

    public function update(Request $request , Thread $thread)
    {
        if (!$request->input('best_answer_id')) {
            $request->validate([
                'title' => ['required'],
                'content' => ['required'],
                'channel_id' => ['required']
            ]);
        }
        else{
            $request->validate([
                'best_answer_id'=>['required'],
            ]);
        }

        if (Gate::forUser(auth()->user())->allows('update-thread',$thread)){
            resolve(ThreadRepository::class)->update($thread,$request);
            return \response()->json([
                'message'=>'thread update successfully'
            ],Response::HTTP_OK);
        }

        return \response()->json([
            'message'=>'thread not update'
        ],Response::HTTP_FORBIDDEN);
    }

    public function destroy(Thread $thread)
    {
        if (Gate::forUser(auth()->user())->allows('update-thread',$thread)){
            resolve(ThreadRepository::class)->destroy($thread);
            return \response()->json([
                'message'=>'Thread deleted'
            ],Response::HTTP_OK);
        }
        return \response()->json([
            'message'=>'Thread not deleted'
        ],Response::HTTP_FORBIDDEN);
    }

}
