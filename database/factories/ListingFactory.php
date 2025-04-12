<?php

namespace Database\Factories;

use App\Models\Listing;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Listing::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(), // Creates a related user
            'main_image' => $this->faker->imageUrl(640, 480, 'products', true, 'Faker'),
            'image' => json_encode([
                $this->faker->imageUrl(640, 480, 'products', true, 'Faker'),
                $this->faker->imageUrl(640, 480, 'products', true, 'Faker'),
            ]),
            'item_name' => $this->faker->words(3, true),
            'price' => $this->faker->numberBetween(10, 1000),
            'category_id' => 1, // Creates a related category
            'condition' => $this->faker->randomElement(['new', 'used', 'refurbished']),
            'quantity' => $this->faker->numberBetween(1, 100),
            'description' => $this->faker->paragraphs(3, true),
            'lat' => $this->faker->latitude(-90, 90),
            'lng' => $this->faker->longitude(-180, 180),
        ];
    }
}
