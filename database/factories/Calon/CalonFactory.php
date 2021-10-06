<?php

namespace Database\Factories\Calon;

use App\Models\Calon\Calon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Calon::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'no_kad_pengenalan' => ( string) $this->faker->numberBetween(900000000000, 999999999999),
            'no_sijil_kelahiran' => 'A' . ( string) $this->faker->numberBetween(000000, 999999),
            'nama' => $this->faker->name,
            'no_telefon_bimbit' => '01' . ( string) $this->faker->numberBetween(10000000, 99999999),
            'emel' => $this->faker->email,
            'tarikh_lahir' => $this->faker->date,
        ];
    }
}
