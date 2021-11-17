<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *    protected $fillable = [
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 2,
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomDigit,
            'discount' => rand(0, 50),
            'approved' => true,
            'picture' => 'uploads/booksCover/default.png',
        ];
    }
}
