<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $imageUrls = [];
        $numImages = $this->faker->numberBetween(1, 3);
        for ($i = 0; $i < $numImages; $i++) {
            $imageUrls[] = 'https://via.placeholder.com/150'; 
        }

        return [
            'name' => $this->faker->unique()->word . ' ' . $this->faker->randomElement(['Apples', 'Oranges', 'Strawberry', 'Banana', 'Pumpkin','Dryfruits']),
            'category' => $this->faker->randomElement(['Apples', 'Oranges', 'Strawberry', 'Banana', 'Pumpkin']),
            'description' => $this->faker->sentence,
            'price' => $this->faker->numberBetween(1, 10),
            'stock' => $this->faker->randomElement(['In stock', 'Out of stock']),
            'images' => implode(',', $imageUrls),
        ];
    }
}
