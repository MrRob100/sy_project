<?php

namespace App\DataFixtures;

use App\Entity\Shot;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ShotFixtures extends Fixture
{
    public const SHOT_1 = 'shot_1';
    public const SHOT_2 = 'shot_2';
    public const SHOT_3 = 'shot_3';

    public function load(ObjectManager $manager): void
    {
        $shot = new Shot();
        $shot->setName('Porrada');
        $shot->setDifficulty(6);
        $manager->persist($shot);

        $shot2 = new Shot();
        $shot2->setName('De Graca');
        $shot2->setDifficulty(2);
        $manager->persist($shot2);

        $shot3 = new Shot();
        $shot3->setName('Shark Attack');
        $shot3->setDifficulty(8);
        $manager->persist($shot3);

        $manager->flush();

        $this->addReference(self::SHOT_1, $shot);
        $this->addReference(self::SHOT_2, $shot2);
        $this->addReference(self::SHOT_3, $shot3);

//        $this->addReference('shot_1', $shot);
//        $this->addReference('shot_2', $shot2);
//        $this->addReference('shot_3', $shot3);
    }
}
