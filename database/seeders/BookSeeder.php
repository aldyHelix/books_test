<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $faker = Faker::create('id_ID');
        for($i = 1; $i <= 10; $i++){
            Book::create(
                [
                    'title' => $faker->word,
                    'author' => $faker->firstNameMale,
                    'total_page' => $faker->randomDigit,
                    'rating' => $faker->randomDigit,
                    'isbn' =>$faker->randomDigit,
                    'publisher' => $faker->word,
                    'available_from' => $faker->dateTimeThisMonth($max = 'now', $timezone = null),
                    'available_until' => $faker->dateTimeThisMonth($max = 'now', $timezone = null),
                    'published_date' => $faker->dateTimeThisMonth($max = 'now', $timezone = null),
                    'price' => $faker->randomDigit,
                    'is_available' => 1,
                    'description' => $faker->text($maxNbChars = 200)
                ]
            );
        }
    }
}
