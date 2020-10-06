<?php

namespace Tests\Feature\API\V01\Answer;

use App\Models\Answer;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AnswerControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_answers()
    {
        $response = $this->get(route('answers.index'));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_create_answers_should_be_validated()
    {
        $response = $this->postJson(route('answers.store'),[]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors(['content','thread_id']);
    }

    public function test_create_answers()
    {
        Sanctum::actingAs(User::factory()->create());
        $thread = Thread::factory()->create();
        $response = $this->postJson(route('answers.store'),[
            'content'=>'Foo',
            'thread_id'=>$thread->id,
        ]);

        $response->assertJson([
           'message'=>'answer created successfully'
        ]);
        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_update_answers_should_be_validated()
    {
        $answer = Answer::factory()->create();
        $response = $this->putJson(route('answers.update',$answer),[]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors(['content','thread_id']);
    }

    public function test_update_answers()
    {
        Sanctum::actingAs(User::factory()->create());
        $answer = Answer::factory()->create([
            'content'=>'Bar'
        ]);

        $response = $this->putJson(route('answers.update',$answer),[
            'content'=>'Foo',
            'thread_id'=>$answer->thread_id
        ]);
        $answer->refresh();
        $response->assertStatus(Response::HTTP_OK);
        $this->assertSame('Foo',$answer->content);

    }


    public function test_delete_answer()
    {
        Sanctum::actingAs(User::factory()->create());
        $answer = Answer::factory()->create();
        $response = $this->deleteJson(route('answers.destroy',$answer),[]);
        $response->assertJson([
            'message'=>'answer deleted successfully'
        ]);
        $response->assertStatus(Response::HTTP_OK);
    }

}
