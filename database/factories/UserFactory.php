<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'information' => [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'phone' => fake()->phoneNumber(),
            ],
            'preferences' => [
                'theme' => 'light',
                'alert_mail' => true,
            ],
            'company_details' => [
                'company_name' => fake()->company(),
                'industry' => fake()->company(),
                'company_color' => fake()->hexColor(),
                'initials' => fake()->lexify('???'),
            ],
            'addresses' => [
                'address' => fake()->address(),
                'city' => fake()->city(),
                'zip' => fake()->postcode(),
                'country' => fake()->country(),
            ],
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
