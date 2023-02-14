<?php

namespace Database\Factories\Data;

use App\Models\Data\NodeTypes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Data\Node>
 */
class NodeFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    return [
      'name' => $this->faker->word,
      'data_type' => $this->faker->randomElement(NodeTypes::keys()),
      'description' => $this->faker->sentence
    ];
  }
}
