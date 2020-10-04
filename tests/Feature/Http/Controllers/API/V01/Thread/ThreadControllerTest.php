<?php


namespace Http\Controllers\API\V01\Thread;


use App\Models\Channel;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ThreadControllerTest extends TestCase
{
    public function test_all_threads_should_be_accessible()
    {
        $response = $this->get(route('threads.index'));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_all_threads_should_be_accessible_by_slug()
    {
        $thread = Thread::factory()->create();
        $response = $this->get(route('threads.show',[$thread->slug]));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_thread_should_be_validate(){
        $response = $this->postJson(route('threads.store'),[]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_create_thread()
    {
        Sanctum::actingAs(User::factory()->create());
        $response = $this->postJson(route('threads.store'),[
            'title'=>'Foo',
            'content'=>'Bar',
            'channel_id'=>Channel::factory()->create()->id
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_update_thread()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $thread = Thread::factory()->create([
            'title'=>'Foo',
            'content'=>'Bar',
            'channel_id'=>Channel::factory()->create()->id,
            'user_id'=>$user->id
        ]);
        $response = $this->putJson(route('threads.update',['thread'=>$thread]),[
            'title'=>'Bar',
            'content'=>'Bar',
            'channel_id'=>Channel::factory()->create()->id
        ])->assertSuccessful();

        $thread->refresh();
        $this->assertSame('Bar',$thread->title);

    }

    public function test_update_best_answer_id_thread()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $thread = Thread::factory()->create([
            'user_id'=>$user->id
        ]);
        $response = $this->putJson(route('threads.update',['thread'=>$thread]),[
            'best_answer_id'=>1
        ])->assertSuccessful();

        $thread->refresh();
        $this->assertSame(1,$thread->best_answer_id);

    }

    public function test_thread_destroy()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $thread = Thread::factory()->create([
            'user_id'=>$user->id
        ]);
        $response = $this->delete(route('threads.destroy',[$thread->id]));
        $response->assertStatus(Response::HTTP_OK);
    }


}
