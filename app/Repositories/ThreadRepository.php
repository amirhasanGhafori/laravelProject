<?php


namespace App\Repositories;


use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ThreadRepository
{
    public function getAllAvailableThreads()
    {
        return Thread::whereFlag(1)->latest()->get();
    }

    public function getThreads($slug)
    {
        $threads = Thread::whereSlug($slug)->whereFlag(1)->get();
    }

    /**
     * @param Request $request
     */
    public function storeThread(Request $request): void
    {
        Thread::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'channel_id' => $request->input('channel_id'),
            'user_id' => auth()->user()->id,
            'slug' => Str::slug($request->input('title'))
        ]);
    }

    public function update(Thread $thread , Request $request): void
    {

        if ($request->has('best_answer_id')){
            $thread->update([
               'best_answer_id'=>$request->input('best_answer_id')
            ]);
        }

        else{
            $thread->update([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'channel_id' => $request->input('channel_id'),
                'slug' => Str::slug($request->input('title'))
            ]);

        }

    }

    public function destroy(Thread $thread)
    {
        $thread->delete();
    }

}
