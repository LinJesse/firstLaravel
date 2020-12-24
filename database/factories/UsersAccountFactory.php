<?php

namespace Database\Factories;

use App\Models\UsersAccount;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsersAccountFactory extends Factory
{
    protected $model = UsersAccount::class;

    public function definition()
    {
        return [
            'account' => $this->faker->unique()->firstName,
            'password' => bcrypt($this->faker->unique()->password(6)),
        ];
    }
}
