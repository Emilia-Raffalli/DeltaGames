<?php

namespace App\DataFixtures;

use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class QuestionFixtures extends Fixture
{
    public const QUESTION_1 = 'QUESTION_1';
    public const QUESTION_2 = 'QUESTION_2';
    public const QUESTION_3 = 'QUESTION_3';
    public const QUESTION_4 = 'QUESTION_4';
    public const QUESTION_5 = 'QUESTION_5';


    public function load(ObjectManager $manager): void
    {
        $questionsData = [
            self::QUESTION_1 => [
                "questionText" => "Quelle est votre nouvelle liaison préférée dans le programme Delta Summer 2024 ? ",
                "hint" => "Échauffement",
                "correctAnswerDescripton" => "Il n'y a pas de mauvaises réponses. Vous pouvez aimer tous nos vols."
            ],

            self::QUESTION_2 => [
                "questionText" => "Au départ de combien de pays d'Europe, du Moyen-Orient, d'Afrique et d'Inde (EMEAI) Delta propose-t-elle un service sans escale vers les États-Unis ?",
                "hint" => "Quel que soit votre pays d'origine, Delta est le choix idéal pour vous rendre aux États-Unis.",
                "correctAnswerDescripton" => "20 pays de la région EMEAI, sont desservis par Delta en vols directs des USA."
            ],
            self::QUESTION_3 => [
                "questionText" => "Quelle est la destination principale de Delta vers les États-Unis ?",
                "hint" => "Cette ville n'a jamais été aussi proche avec des vols sans escale depuis 29 villes de la zone EMEAI. ",
                "correctAnswerDescripton" => "New York n'a jamais été aussi proche! C'est la destination transatlantique numéro 1 de Delta."
            ],
            self::QUESTION_4 => [
                "questionText" => "Quel est le nombre de vols hebdomadaires sans escale assurés par Delta au départ de la zone EMEAI cet été ? ",
                "hint" => "Chacun trouvera forcément un siège à sa convenance avec le plus grand programme transatlantique jamais proposé par Delta.",
                "correctAnswerDescripton" => "Delta va opérer jusqu'à 680 vols par semaine cet été au départ de la région EMEAI."
            ],
            self::QUESTION_5 => [
                "questionText" => "Pour combien de destinations aux États-Unis Delta propose-t-elle des correspondances faciles ?",
                "hint" => "Plus à découvrir dans tous les États-Unis ",
                "correctAnswerDescripton" => "Delta offre des correspondances faciles vers plus de 200 destinations à travers les États-Unis."
                ]
        ];

        foreach ($questionsData as $reference => $data) {
            $question = new Question();
            $question->setQuestionText($data['questionText']);
            $question->setHint($data['hint']);
            $question->setCorrectAnswerDescription($data['correctAnswerDescripton']);
            $manager->persist($question);
            $this->addReference($reference, $question);
        }
        $manager->flush();
    }
}
