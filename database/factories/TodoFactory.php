<?php

namespace Database\Factories;


use App\Models\Category;

use App\Models\Priority;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_id=User::pluck('id');
        $priority_id=Priority::pluck('id');
        $category_id=Category::pluck('id');
        return [
            'title'=>fake()->title(),
            'description'=>fake()->paragraph(),
            'user_id'=>$user_id->random(),
            'category_id'=>$category_id->random(),
            'priority_id'=>$priority_id->random(),
        ];
    }
}
