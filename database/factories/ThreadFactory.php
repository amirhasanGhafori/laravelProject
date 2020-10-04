<?php

namespace Database\Factories;

use App\Models\Channel;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $name = $this->faker->sentence(3);
        return [
            'title'=>$name,
            'content'=>$this->faker->sentence(2),
            'slug'=>Str::slug($name),
            'user_id'=>User::factory()->create()->id,
            'channel_id'=>Channel::factory()->create()->id
        ];
    }
}
