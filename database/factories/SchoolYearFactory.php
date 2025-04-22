<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SchoolYear;

class SchoolYearFactory extends Factory
{
    protected $model = SchoolYear::class; // Ensure this matches the model

    public function definition()
    {
        return [
            'year' => $this->faker->year,
            'active' => $this->faker->boolean(50), // Randomly true/false for active year
        ];
    }
}
