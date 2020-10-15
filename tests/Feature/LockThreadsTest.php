<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LockThreadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_administrators_may_not_lock_threads()
    {
        $this->signIn();

        $thread = create('App\Models\Thread', ['user_id' => auth()->id()]);

        $this->post(route('locked-threads.store', $thread))->assertStatus(403);

        $this->assertFalse(!! $thread->fresh()->locked);
    }

    /** @test */
    public function administrators_can_lock_threads()
    {
        $this->signIn(User::factory()->administrator()->create());

        $thread = create('App\Models\Thread', ['user_id' => auth()->id()]);

        $this->post(route('locked-threads.store', $thread));

        $this->assertTrue(!! $thread->fresh()->locked, 'Failed asserting that the thread is locked.');
    }

    /** @test */
    public function once_locked_a_thread_may_not_receive_new_replies()
    {
        $this->signIn();

        $thread = create('App\Models\Thread');

        $thread->lock();

        $this->post($thread->path() . '/replies', [
            'body' => 'Foobar',
            'user_id' => create('App\Models\User')->id
        ])->assertStatus(422);
    }
}
