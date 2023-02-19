<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class PostFactory extends Factory
{
    
    public function definition()
    {
        $address = ['yangon','mandalay','bago','inn lay'];
        return [
            'title' => $this->faker->text(10),
            'description'=> $this -> faker-> text(1000),
            'price'=>rand(2000,50000),
            'address'=> $address[array_rand($address)],
            'rating'=>rand(0,5)
        ];
    }
}
