<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Product>
 */
final class ProductFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = Product::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'product_code' => $this->faker->word,
            'type' => $this->faker->randomElement(['inventory', 'service']),
            'name' => $this->faker->name,
            'category' => $this->faker->word,
            'sku_code' => $this->faker->optional()->word,
            'brand' => $this->faker->optional()->word,
            'harmonic_number' => $this->faker->optional()->numberBetween(0, 5055),
            'unit' => $this->faker->word,
            'units' => $this->faker->optional()->word,
            'description' => $this->faker->optional()->text,
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'variation' => $this->faker->boolean,
            'image' => $this->faker->optional()->word,
            'supplier_id' => $this->faker->randomNumber(),
            'purchase_unit' => $this->faker->word,
            'reorder_threshold_quantity' => $this->faker->optional()->numberBetween(0, 5858),
            'selling_price' => $this->faker->numberBetween(0, 4440),
            'selling_unit' => $this->faker->word,
            'discount_amount' => $this->faker->optional()->numberBetween(0, 2525),
            'discount_type' => $this->faker->optional()->randomElement(['fixed', 'percentage']),
            'sales_return' => $this->faker->boolean,
            'tax_type' => $this->faker->randomElement(['inclusive', 'exclusive']),
            'tax_id' => $this->faker->optional()->randomNumber(),
            'batch_tracking' => $this->faker->boolean,
            'serial_tracking' => $this->faker->boolean,
            'shipping' => $this->faker->boolean,
            'free_shipping' => $this->faker->boolean,
            'tags' => json_encode(['color', 'size']),
            'warranty_period' => $this->faker->optional()->randomNumber(),
            'promotional_message' => $this->faker->optional()->text,
            'disclaimer' => $this->faker->optional()->text,
        ];
    }
}
