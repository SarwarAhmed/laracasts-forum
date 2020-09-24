<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadThradsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->thread = Thread::factory()->create();
    }

    /** @test */
    public function a_user_can_view_all_threads()
    {
        $this->get('/threads')
            ->assertSee($this->thread->tiitle);
    }

    /** @test */
    public function a_user_can_read_a_single_thread()
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = Reply::factory()
            ->create(['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }

    /** @test */
    public function a_user_can_filter_threads_according_to_a_channel()
    {
        $this->withoutExceptionHandling();

        $channel = create('App\Models\Channel');
        $threadInChannel = create('App\Models\Thread', ['channel_id' => $channel->id]);
        // $threadInChannel = Thread::factory()->create(['channel_id' => $channel_id]);
        $threadNotInChannel = create('App\Models\Thread');

        $this->get('/threads/' . $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel);
    }

    /** @test */
    public function a_user_can_filter_threads_by_any_user_name()
    {
        $this->withoutExceptionHandling();

        $this->signIn(create('App\Models\User', ['name' => 'JohnDoe']));

        $threadByJohn = create('App\Models\Thread', ['user_id' => auth()->id()]);
        $threadNotByJohn = create('App\Models\Thread');

        $this->get('threads?by=JohnDoe')
            ->assertSee($threadByJohn->title)
            ->assertDontSee($threadNotByJohn->title);
    }

    /** @test */
    public function a_user_can_filter_threads_by_popularity()
    {
        $this->withoutExceptionHandling();

        $threadWithTwoReplies = create('App\Models\Thread');
        create('App\Models\Reply', ['thread_id' => $threadWithTwoReplies], 2);

        $threadWithThreeReplies = create('App\Models\Thread');
        create('App\Models\Reply', ['thread_id' => $threadWithThreeReplies], 3);

        $threadWithNoReplies = $this->thread;

        $response = $this->getJson('threads?popular=1')->json();

        $this->assertEquals([3, 2, 0, 0, 0, 0, 0, 0], array_column($response, 'replies_count'));
    }

    /** @test */
    public function a_user_can_request_all_replies_for_a_given_thread()
    {
        $thread = create('App\Models\Thread');
        create('App\Models\Reply', ['thread_id' => $thread->id], 2);

        $response = $this->getJson($thread->path() . '/replies')->json();

        $this->assertCount(1, $response['data']);
        $this->assertEquals(2, $response['total']);
    }
}
