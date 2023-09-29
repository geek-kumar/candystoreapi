<?php

namespace Database\Factories;

use App\Models\Store;
use App\Models\Customer;
use App\Models\Inventory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id'   => Customer::factory(),
            'inventory_id'  => Inventory::factory(),
            'store_id'      => Store::factory(),
            'quantity'      => $this->faker->randomDigit(0),
            'status'      => $this->faker->numberBetween(1,5)
        ];
    }
}
