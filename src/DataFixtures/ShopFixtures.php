<?php

namespace App\DataFixtures;

use App\Entity\Shop;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ShopFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    	$faker = Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
        	$shop = new Shop();
        	$shop->setName('Commerce ' . $i)
				->setAddress($faker->address)
				->setCity($faker->city)
				->setDescription($faker->text)
				->setLatitude($faker->latitude)
				->setLongitude($faker->longitude)
				->setPostalCode($faker->postcode)
				->setStreet($faker->streetAddress);

        	$manager->persist($shop);
		}
        $manager->flush();
    }
}
