<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'google_id' => $faker->word,
        'title' => $faker->sentence(4),
        'description' => $faker->text,
        'published_at' => $faker->date(),
        'price' => $faker->randomFloat(2, 0, 999999.99),
        'preview_link' => $faker->word,
        'author_id' => factory(\App\Author::class),
        'page_count' => $faker->numberBetween(-10000, 10000),
        'thumbnail' => $faker->word,
        'language' => $faker->word,
        'pdf' => $faker->word,
    ];
});
