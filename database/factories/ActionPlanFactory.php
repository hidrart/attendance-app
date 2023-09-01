<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Work;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ActionPlan>
 */
class ActionPlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // get random work and user
        $work = Work::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();

        return [
            'user_id' => $user->id,
            'work_id' => $work->id,
            'plan' => $this->faker->sentence(2),
            'analysis' => $this->faker->sentence(3),
            'recommendation' => $this->faker->sentence(3),
            'status' => $this->faker->randomElement(['pending', 'ongoing', 'completed']),
        ];
    }
}
