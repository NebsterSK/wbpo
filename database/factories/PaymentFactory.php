<?php

namespace Database\Factories;

use App\Enums\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'payer_name' => $this->faker->name(),
            'payer_email' => $this->faker->email(),
            'payer_address' => $this->faker->address(),
            'amount' => $this->faker->numberBetween(1, 1234), // 0,01 - 12,34
            'currency' => $this->faker->randomElement(Currency::toArray()),
            'provider' => 'test',
        ];
    }
}
