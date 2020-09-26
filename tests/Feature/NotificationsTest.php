<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotificationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_notification_is_prepared_when_a_subscribed_thread_receives_a_new_reply_that_is_not_by_the_current_user()
    {
        $this->signIn();

        $thread = create('App\Models\Thread')->subscribe();

        $this->assertCount(0, auth()->user()->notifications);

        $thread->addReply([
            'user_id' => auth()->id(),
            'body' => 'Some reply'
        ]);

        $this->assertCount(0, auth()->user()->notifications);

        $thread->addReply([
            'user_id' => create('App\Models\User')->id,
            'body' => 'Some reply'
        ]);

        $this->assertCount(1, auth()->user()->fresh()->notifications);
    }

    /** @test */
    public function a_user_fetch_their_unread_notifications()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $thread = create('App\Models\Thread')->subscribe();

        $thread->addReply([
            'user_id' => create('App\Models\User')->id,
            'body' => 'Some reply'
        ]);

        $user = auth()->user();

        $response = $this->getJson("/profiles/{$user->name}/notifications")->json();

        $this->assertCount(1, $response);
    }

    /** @test */
    public function a_user_can_mark_a_notification_as_read()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $thread = create('App\Models\Thread')->subscribe();

        $thread->addReply([
            'user_id' => create('App\Models\User')->id,
            'body' => 'Some reply'
        ]);

        $user = auth()->user();

        $this->assertCount(1, $user->unreadnotifications);

        $notificationId = $user->unreadNotifications->first()->id;

        $this->delete("/profiles/{$user->name}/notifications/{$notificationId}");

        $this->assertCount(0, $user->fresh()->unreadnotifications);
    }
}
