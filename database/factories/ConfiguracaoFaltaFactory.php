<?php

namespace Database\Factories;

use App\Models\ConfiguracaoFalta;
use Illuminate\Database\Eloquent\Factories\Factory;

use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConfiguracaoFalta>
 */
class ConfiguracaoFaltaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ConfiguracaoFalta::class;

    public function definition(): array
    {
        return [
            'nome_da_politica' => $this->faker->unique()->word,
            'descricao' => $this->faker->sentence,
            'limite_ausencias' => $this->faker->numberBetween(1, 10),
            'tipo_desconto' => $this->faker->randomElement(['numerario', 'percentagem']),
            'valor_desconto' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
