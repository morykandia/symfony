<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Product;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

       

        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->setTitle("Nike Sportswear")
                ->setPrice(40.50)
                ->setImage("https://img01.ztat.net/article/spp-media-p1/5e3e5399e0ac31f0a228f06e897f0d29/128872db90fd40068cd55aeff0f53ce6.jpg?imwidth=762");

            $manager->persist($product);
        }

        $manager->flush();
    }
}
