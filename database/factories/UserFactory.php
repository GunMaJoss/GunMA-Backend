<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),

            'isAdmin' => rand(0,1),
            'isVerified' => rand(0,1),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->randomNumber(5,true),
            'description' => $this->faker->sentence(rand(4,10)),
            'email_verified_at' => now(),
            'password' => $this->faker->password(),
            'imageUrl' => $this->faker->url(),
            //
            //
        ];
    }
}
