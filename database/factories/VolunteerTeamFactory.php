<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\VolunteerTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VolunteerTeam>
 */
class VolunteerTeamFactory extends Factory
{
    protected $model = VolunteerTeam::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'church_name' => fake()->company(),
            'responsible_officer' => fake()->name(),
            'responsible_officer_phone' => fake()->phoneNumber(),
            'activities' => ['evangelism', 'education'],
            'available_start' => null,
            'available_end' => null,
            'is_available' => true,
        ];
    }
}
