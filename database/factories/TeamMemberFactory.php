<?php

namespace Database\Factories;

use App\Models\TeamMember;
use App\Models\VolunteerTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeamMember>
 */
class TeamMemberFactory extends Factory
{
    protected $model = TeamMember::class;

    public function definition(): array
    {
        return [
            'team_id' => VolunteerTeam::factory(),
            'name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'church' => null,
            'pastor_name' => null,
            'pastor_phone' => null,
            'role' => null,
            'photo_path' => null,
            'description' => null,
            'specialty' => null,
            'status' => 'pending',
            'file_paths' => null,
        ];
    }
}
