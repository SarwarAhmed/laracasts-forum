<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthenticated_user_may_not_add_replies()
    {
        $this->expectException(AuthenticationException::class);
        $this->withoutExceptionHandling();

        $thread = Thread::factory()->create();

        $reply = Reply::factory()->create();
        $this->post('/threads/1/replies', []);
    }

    /** @test */
    public function an_autheticated_user_may_participate_in_forum_threads()
    {
        $this->withoutExceptionHandling();

        $this->be($user = User::factory()->create());

        $thread = Thread::factory()->create();

        $reply = Reply::factory()->make();

        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }
}
