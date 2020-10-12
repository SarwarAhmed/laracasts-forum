<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThreadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Thread::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;

        return [
            'user_id' => User::factory()->create(),
            'channel_id' => Channel::factory()->create(),
            'title' => $title,
            'body' => $this->faker->paragraph,
            'slug' => Str::slug($title),
            'visits' => 0,
        ];
    }
}
