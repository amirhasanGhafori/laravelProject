<?php

namespace App\Http\Controllers\API\V01\Answer;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Repositories\AnswerRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AnswerController extends Controller
{

    public function index()
    {
        $answers = resolve(AnswerRepository::class)->getAllAnswers();
        return response()->json($answers , Response::HTTP_OK);
    }


    public function store(Request $request)
    {
        $request->validate([
            'content'=>['required'],
            'thread_id'=>['required'],
        ]);

        resolve(AnswerRepository::class)->create($request);

        return \response()->json([
            'message'=>'answer created successfully'
        ],Response::HTTP_CREATED);

    }


    public function update(Request $request, Answer $answer)
    {
        $request->validate([
            'content'=>'required',
            'thread_id'=>'required'
        ]);

       resolve(AnswerRepository::class)->update($request , $answer);

        return \response()->json([
            'message'=>'answer updated successfully'
        ],Response::HTTP_OK);

    }


    public function destroy(Answer $answer)
    {
        resolve(AnswerRepository::class)->delete($answer);
        return \response()->json([
            'message'=>'answer deleted successfully'
        ],Response::HTTP_OK);
    }
}
