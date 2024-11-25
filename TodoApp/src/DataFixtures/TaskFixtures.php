<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TaskFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $task1 = new Task();
        $task1->setContent("Task 1");
        $manager->persist($task1);

        $task2 = new Task();
        $task2->setContent("Task 2");
        $manager->persist($task2);

        $task3 = new Task();
        $task3->setContent("Task 3");
        $manager->persist($task3);

        $manager->flush();
    }
}
