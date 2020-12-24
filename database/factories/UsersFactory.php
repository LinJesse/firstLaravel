<?php

namespace Database\Factories;

use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsersFactory extends Factory
{
    
    protected $model = Users::class;

    public function definition()
    {
        //$this->call();
        return [
            'name' => $this->faker->unique()->firstName,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->unique()->e164PhoneNumber,
            'password' => bcrypt($this->faker->unique()->password(6)),
            'user_account_id' => rand(1,10),
            'lastLogin' => $this->faker->dateTime,
        ];
    }
}
