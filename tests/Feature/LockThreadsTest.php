<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LockThreadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_administrator_can_lock_any_thread()
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
