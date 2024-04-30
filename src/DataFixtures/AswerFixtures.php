<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AswerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        $answersData = [
            QuestionFixtures::QUESTION_1 => [
                ["A. Munich à New York-JFK", true],
                ["B. Naples à New York-JFK", true],
                ["C. Shannon à New York-JFK", true],
                ["D. Dublin à Minneapolis-St. Paul", true],
                ["E. Toutes les réponses ci-dessus", true]
            ],
            QuestionFixtures::QUESTION_2 => [
                ["A. 20 ", true],
                ["B. 25 ", false],
                ["C. 22", false],
                ["D. 30", false],
            ],
            QuestionFixtures::QUESTION_3 => [
                ["A. Los Angeles", false],
                ["B. New York-JFK", true],
                ["C. Atlanta", false],
                ["D. Boston", false],
            ],
            QuestionFixtures::QUESTION_4 => [
                ["A. Plus de 700", false],
                ["B. Moins de 600 ", false],
                ["C. Jusqu'à 680 ", true],
                ["D. Aucune de ces réponses", false],
            ],
            QuestionFixtures::QUESTION_5 => [
                ["A. Moins de 150", false],
                ["B. Plus de 200", true],
                ["C. Jusqu'à 100 ", false],
                ["D. Aucune de ces réponses", false],
            ],
        ];

        foreach ($answersData as $questionReference => $answers) {
            foreach ($answers as list($answerText, $isCorrect)) {
                $answer = new Answer();
                $answer->setAnswer($answerText);
                $answer->setCorrect($isCorrect);
                $answer->setQuestion($this->getReference($questionReference));

                $manager->persist($answer);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            QuestionFixtures::class,
        ];
    }
}
