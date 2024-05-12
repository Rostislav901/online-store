<?php

namespace App\DataFixtures;

use App\ProductCatalog\Domain\Factory\CategoryFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly CategoryFactory $factory)
    {
    }

    public function load(ObjectManager $manager)
    {
        $health = $this->factory->create('Health', null);
        $fitness = $this->factory->create('Fitness', $health);
        $relaxation = $this->factory->create('Relaxation', $health);

        $technology = $this->factory->create('Technology', null);
        $computersAndLaptops = $this->factory->create('Computers and Laptops', $technology);
        $apple = $this->factory->create('apple-laptops', $computersAndLaptops);

        $food = $this->factory->create('Food', null);

        $this->em->persist($health);
        $this->em->persist($fitness);
        $this->em->persist($relaxation);
        $this->em->persist($technology);
        $this->em->persist($computersAndLaptops);
        $this->em->persist($apple);
        $this->em->persist($food);

        $this->em->flush();
    }
}
