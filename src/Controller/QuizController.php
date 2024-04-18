<?php

namespace App\Controller;

use App\Entity\Participation;
use App\Entity\Question;
use App\Entity\User;
use App\Form\QuizAnswerType;
use App\Form\UserType;
use App\Repository\ParticipationRepository;
use App\Repository\QuestionRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;

class QuizController extends AbstractController
{

    #[Route('/', name: 'app_start')]
    public function homeQuiz(SessionInterface $session,
    ): Response
    {

        if (!$session->isStarted()) {
            $session->start();
        }

        // return $this->redirectToRoute('next_page_route');
    
        return $this->render('quiz/index.html.twig', [
            'pageTitle' => 'Start Now',
        ]);
    }

    #[Route('/quiz/{id}', name: 'app_quiz')]
    public function quiz(
        SessionInterface $session, 
        Request $request, 
        QuestionRepository $questionRepository, 
        ParticipationRepository $participationRepository, 
        EntityManagerInterface $em,
        int $id =1
    ): Response {

        $questionId = $id; 

        // 1- Récupérer la participation de l'utilisateur
        $userSession = $session->getId();
        $participation = $participationRepository->findOneBy(['userSession' => $userSession]);

        // 2- Créer une participation si elle n'existe pas
        if (!$participation) {
            $participation = new Participation();
            $participation->setUserSession($userSession);
            $em->persist($participation);
            $em->flush();
        }

        // Récupérer la première question et ses réponses associées
        $question = $questionRepository->find($questionId);
        if($question != null) {
            $answers = $question->getAnswers()->toArray();
            // dd($answers);
        // dd($answers);

        //gestion des questions déjà cochées
        // $answered = false;
        // $selectedAnswer = null;
        // if ($participation && $participation->getQuestions()->contains($question)) {
        //     $answered = true;
        //     $selectedAnswer = $participation->getSelectedAnswers($question);
        // }


        //formulaire
        $form = $this->createForm(QuizAnswerType::class, null, [
            'answers' => $answers, 
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $selectedAnswer = $form->get('answer')->getData();
            // dd($selectedAnswer);
             // Ajouter les données à la session de participation
            if (!$participation->getQuestions()->contains($question)) {
                $participation->addQuestion($question);
                $participation->addSelectedAnswer($selectedAnswer);
                $em->persist($participation);
                $em->flush();
            }
            
            $maxQuestionId = $questionRepository->findMaxQuestionId();
            
            if ($questionId >= $maxQuestionId) {

                $totalSelectedAnswers = $participation->getSelectedAnswers()->toArray();
                // $countCorrectAnswers = 0;

                $hasWin = TRUE;
                foreach ($totalSelectedAnswers as $answer) {
                    if (!$answer->isCorrect()){
                        $hasWin = FALSE;
                        break;
                    }
                }
                // dd($countCorrectAnswers);
                //$countAllQuestions = count($questionRepository->findAll());
                // dd($countAllQuestions);

                //if ($countCorrectAnswers == $countAllQuestions) {
                    if ($hasWin) {
                    return $this->redirectToRoute(('app_won'));
                } else {
                    return $this->redirectToRoute(('app_lost'));
                }
            }

            // dd($participation->getSelectedAnswers());

            // dd($participation);
            $nextQuestionId = $questionId + 1;

            return $this->redirectToRoute('app_quiz', ['id' => $nextQuestionId]);
        }
    }

        return $this->render('quiz/quiz.html.twig', [
            'pageTitle' => 'Delta Air',
            'question' => $question,
            'form' => $question ? $form->createView() : null,
            'answers' => $answers
        ]);
    }


    
    #[Route('/won', name: 'app_won')]
    public function wonQuiz(
        SessionInterface $session, 
        Request $request, 
        ParticipationRepository $participationRepository, 
        EntityManagerInterface $em,
        UserRepository $userRepository,
        MailerInterface $mailer,
        ): Response
    {
    
    $userSession = $session->getId();
    $participation = $participationRepository->findOneBy(['userSession' => $userSession]);

    $errorMessage = null; 

    $user = new User();
    $form = $this->createForm(UserType::class,$user);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        
        $em->persist($user);
        $em->flush();


        $email = (new TemplatedEmail())
        ->from('e.raffalli@hotmail.fr')
        ->to(new Address($user->getEmail()))
        //->cc('cc@example.com')
        //->bcc('bcc@example.com')
        //->replyTo('fabien@example.com')
        //->priority(Email::PRIORITY_HIGH)
        ->subject('Merci pour votre participation!')
        // ->text('Sending emails is fun again!')
        // ->html('<p>See Twig integration for better HTML integration!</p>')
        ->htmlTemplate('email/signup.html.twig')
          // change locale used in the template, e.g. to match user's locale
        ->locale('de')

        // pass variables (name => value) to the template
        ->context([
            'expiration_date' => new \DateTime('+7 days'),
            'username' => $user->getFirstName().' '.$user->getLastName(),
        ]);


    $mailer->send($email);





        return $this->redirectToRoute('app_success');


       /* $em->flush();
        
        $userData = $form->getData();

        $submittedEmail = $userData->getEmail();

        // Vérification si l'email n'est pas déjà existant
        $existingUser = $userRepository->findOneBy(['email' => $submittedEmail]);

        if ($existingUser) {
            $errorMessage = "Email déjà enregistré.";
        } else {
            $user = new User();
            $user->setFirstName($userData->getFirstName());
            $user->setLastName($userData->getLastName());
            $user->setEmail($submittedEmail); 
            $user->setAdress($userData->getAdress());
            $user->setAdress2($userData->getAdress2());
            $user->setZipCode($userData->getZipCode());
            $user->setCity($userData->getCity());
            $user->setCountry($userData->getCountry());
    
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('app_success');

            // dd($user);
        }*/
    }

        return $this->render('quiz/won.html.twig', [
            'pageTitle' => 'Game win',
            'participation' => $participation,
            'form' => $form->createView(),
            'errorMessage' => isset($errorMessage) ? $errorMessage : null,
        ]);
    }

    #[Route('/lost', name: 'app_lost')]
    public function looseQuiz(SessionInterface $session, Request $request): Response
    {
        // dd($session);
        return $this->render('quiz/lost.html.twig', [
            'pageTitle' => 'Game lost',
        ]);
    }

    #[Route('/answers', name: 'app_answers')]
    public function showAnswers(QuestionRepository $questionRepository): Response
    {
        $title = 'QUIZ ANSWERS';
        $questions = $questionRepository->findAll();

        return $this->render('quiz/answers.html.twig', [
            'pageTitle' => 'Réponses du quiz',
            'title' => $title,
            'questions' => $questions
        ]);
    }

    #[Route('/thank-you', name: 'app_success')]
    public function thankYou(): Response
    {
        return $this->render('quiz/thank-you.html.twig', [
            'pageTitle' => 'Thank you',
        ]);
    }



}



// public function quizPage(Request $request)
//     {
//         $entityManager = $this->getDoctrine()->getManager();
//         $questionRepository = $entityManager->getRepository(Question::class);
//         $answerRepository = $entityManager->getRepository(Answer::class);
//         $participationRepository = $entityManager->getRepository(Participation::class);

//         // Récupérer l'ID de la première question
//         $firstQuestionId = 1; // Vous pouvez définir l'ID de la première question ici

//         // Récupérer la participation de l'utilisateur
//         $userSession = $request->getSession()->getId();
//         $participation = $participationRepository->findOneBy(['userSession' => $userSession]);

//         // Créer une participation si elle n'existe pas
//         if (!$participation) {
//             $participation = new Participation();
//             $participation->setUserSession($userSession);
//             $entityManager->persist($participation);
//             $entityManager->flush();
//         }

//         // Récupérer la première question et ses réponses associées
//         $firstQuestion = $questionRepository->find($firstQuestionId);
//         $answers = $answerRepository->findBy(['question' => $firstQuestion]);

//         // Gérer la soumission du formulaire
//         $submitted = false;
//         $selectedAnswer = null;

//         if ($request->isMethod('POST')) {
//             $submitted = true;
//             $selectedAnswerId = $request->request->get('selected_answer_id');

//             if ($selectedAnswerId) {
//                 $selectedAnswer = $answerRepository->find($selectedAnswerId);
//                 // Ajouter les données à la session de participation
//                 $participation->addQuestion($firstQuestion);
//                 $participation->addSelectedAnswer($selectedAnswer);
//                 $entityManager->flush();

//                 // Passer à la question suivante
//                 $nextQuestionId = $firstQuestionId + 1;
//                 // Rediriger vers la page du quiz avec la prochaine question
//                 return $this->redirectToRoute('quiz_page', ['question_id' => $nextQuestionId]);
//             }
//         }

//         return $this->render('quiz/quiz_page.html.twig', [
//             'question' => $firstQuestion,
//             'answers' => $answers,
//             'submitted' => $submitted,
//             'selected_answer' => $selectedAnswer
//         ]);
//     }