<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inquiry>
 */
class InquiryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'telephone' => $this->faker->phoneNumber(),
            'mobile' => $this->faker->phoneNumber(),
            'company' => $this->faker->company(),
            'subject' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
        ];
    }
}
