<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male','female']);
        $lname = $this->faker->lastName;
        $mname = $this->faker->lastName;

        return [
            'id_number' => $this->faker->randomNumber,
            'id_extension' => $this->faker->randomElement(['1T22','2T22','3T22']),
            'last_name' => $lname,
            'first_name' => $gender=="male"?$this->faker->firstNameMale:$this->faker->firstNameFemale,
            'middle_name' => $mname,
            'birth_date' => $this->faker->dateTimeBetween('-25 years', '-18 years'),
            'sex' => $gender,
            'father' => $this->faker->firstNameMale . " " . $lname,
            'mother' => $this->faker->firstNameFemale . " " . $mname
        ];
    }
}
