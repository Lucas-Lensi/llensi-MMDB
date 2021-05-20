<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Studio;
use App\Entity\User;
use Faker;
use \joshtronic\LoremIpsum;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Movie($faker));
        $lipsum = new \joshtronic\LoremIpsum();


        $actors = [];
        for ($i = 0; $i < 50; $i++) {
            $actor = new Actor();
            $actor->setFirstName($faker->firstName());
            $actor->setLastName($faker->lastName());
            $manager->persist($actor);
            $actors[] = $actor;
        }

        $genres = [];
        for ($i = 0; $i < 15; $i++) {
            $genre = new Genre();
            $genre->setName($faker->movieGenre);
            $manager->persist($genre);
            $genres[] = $genre;
        }

        $studios = [];
        for ($i = 0; $i < 15; $i++) {
            $studio = new Studio();
            $studio->setName($faker->studio);
            $manager->persist($studio);
            $studios[] = $studio;
        }

        $movies = [];
        for ($i = 0; $i < 100; $i++) {
            $movie = new Movie();
            $movie->setName($faker->movie);
            $movie->setOriginalName($faker->movie);
            $movie->setReleaseDate($faker->dateTimeAD($max = 'now', $timezone = null));
            $movie->setSynopsis($lipsum->paragraphs(5));
            // $movie->setCreatedAt(new DateTime());
            for ($j=0; $j < 5; $j++) {
                $movie->addActor($actors[$faker->numberBetween(0,49)]);
            }
            for ($j=0; $j < 3; $j++) {
                $movie->addGenre($genres[$faker->numberBetween(0,14)]);
            }
            $movie->setStudio($studios[$faker->numberBetween(0,14)]);
            $manager->persist($movie);
            $movies[] = $movie;
        }
        // imageUrl($width, $height, 'cats')

        $users = [];
        for ($i = 0; $i < 50; $i++) {
            $user = new User();
            $user->setFirstName($faker->firstName());
            $user->setLastName($faker->lastName());
            $user->setEmail($faker->email);
            $user->setPassword($faker->password());
            $manager->persist($user);
            $users[] = $user;
        }

        $manager->flush();
    }
}