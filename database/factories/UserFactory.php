<?php

namespace Database\Factories;

use App\Models\SchoolYear;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = User::class;
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'school_class' => $this->faker->numberBetween(1, 9),
            'class_teacher' => $this->faker->name(gender: null),
            'is_teacher' => $this->faker->numberBetween(0, 1),
            'is_banned' => $this->faker->numberBetween(0, 1),
            'email' => $this->faker->unique()->safeEmail(),
            'school_year_id' => SchoolYear::factory(),
        ];
    }
}
