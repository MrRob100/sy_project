<?php

namespace App\DataFixtures;

use App\Entity\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PlayerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $player = new Player();
        $player->setName('Brisa');
        $player->setBestShot($this->getReference(ShotFixtures::SHOT_3));
        $manager->persist($player);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ShotFixtures::class,
        ];
    }}
