<?php

namespace Database\Factories;

use App\Models\EmergencyEvent;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmergencyEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmergencyEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'event_title' => $this->faker->word(),
            'event_date'  => $this->faker->date(),
        ];
    }
}
