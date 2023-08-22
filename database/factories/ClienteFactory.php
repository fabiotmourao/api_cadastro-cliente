<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cpf' => fake()->numerify('###########'),
            'nome' => fake()->name,
            'data_nascimento' => fake()->date,
            'sexo' => fake()->randomElement($array = array ('Masculino', 'Feminino', 'Outro')),
            'endereco' => fake()->address,
            'estado' =>  fake()->stateAbbr,
            'cidade' =>  fake()->city,
        ];
    }
}
