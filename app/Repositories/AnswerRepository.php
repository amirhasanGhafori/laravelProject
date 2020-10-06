<?php


namespace App\Repositories;


use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerRepository
{
    public function getAllAnswers()
    {
        return Answer::query()->latest()->get();
    }

    public function create(Request $request)
    {
        Answer::create([
            'content'=>$request->input('content'),
            'thread_id'=>$request->input('thread_id'),
            'user_id'=>auth()->user()->id
        ]);
    }

    public function update(Request $request , Answer $answer)
    {
        $answer->update([
            'content'=>$request->input('content'),
            'thread_id'=>$request->input('thread_id')
        ]);
    }

    public function delete(Answer $answer)
    {
        $answer->delete();
    }
}
