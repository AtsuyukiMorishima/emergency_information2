<?php

namespace Database\Factories;

use App\Models\EmergencyEvent;
use App\Models\SiteUrl;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiteUrlFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SiteUrl::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $eeIds = EmergencyEvent::pluck('ee_id')->all();

        return [
            'ee_id'             => $this->faker->randomElement($eeIds),
            'url'               => $this->faker->url(),
            'registration_date' => $this->faker->date(),
        ];
    }
}
