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
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Form\FormError;
use Symfony\Component\Mime\Address;
use Symfony\Config\Framework\TranslatorConfig;
use Symfony\Contracts\Translation\TranslatorInterface;

class QuizController extends AbstractController
{

    #[Route('/', name: 'app_start')]
    #[Route('/thank-you', name: 'app_success')]
    public function homeQuiz(SessionInterface $session, TranslatorInterface $translator
    ): Response
    {
        if (!$session->isStarted()) {
            $session->start();
        }

        $pageTitle = [
            'app_start' => $translator->trans('pageTitle.app_start'),
            'app_success' => $translator->trans('pageTitle.app_success'),
        ];

        return $this->render('quiz/index.html.twig', [
            'pageTitle' => $pageTitle,
        ]);
    }


    #[Route('/quiz/{id}', name: 'app_quiz')]
    public function quiz(
        SessionInterface $session, 
        Request $request, 
        QuestionRepository $questionRepository, 
        ParticipationRepository $participationRepository, 
        EntityManagerInterface $em,
        TranslatorInterface $translator,
        int $id = null
    ): Response {

        if ($id == null) {
            return $this->redirectToRoute('app_start');
        }

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

        $form = $this->createForm(QuizAnswerType::class, null, [
            'answers' => $answers, 
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->get('answer')->getData() == null ) {
            $formError = 'Vous devez sélectionner une réponse.';
        }

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
                    if ($hasWin) {
                    return $this->redirectToRoute(('app_won'));
                } else {
                    return $this->redirectToRoute(('app_lost'));
                }
            }

                // dd($participation);

                $nextQuestionId = $questionId + 1;

                return $this->redirectToRoute('app_quiz', ['id' => $nextQuestionId]);
            }
        }

        $pageTitle = [
            'app_quiz' => $translator->trans('pageTitle.app_quiz'),
        ];

        // dd($pageTitle);

        return $this->render('quiz/quiz.html.twig', [
            'pageTitle' => $pageTitle,
            'question' => $question,
            'form' => $question ? $form->createView() : null,
            'answers' => $answers,
            'formError' => isset($formError) ? $formError : null 
        ]);
    }



    #[Route('/won', name: 'app_won')]
    #[Route('/lost', name: 'app_lost')]
    #[Route('/answers', name: 'app_answers')]
    public function wonQuiz(
        SessionInterface $session, 
        Request $request, 
        ParticipationRepository $participationRepository, 
        EntityManagerInterface $em,
        MailerInterface $mailer,
        QuestionRepository $questionRepository,
        TranslatorInterface $translator
        ): Response
    {
    
    $allQuestions = $questionRepository->findAll();


    $userSession = $session->getId();
    $participation = $participationRepository->findOneBy(['userSession' => $userSession]);

    $errorMessage = null; 

    $user = new User();
    $form = $this->createForm(UserType::class, $user);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $em->persist($user);
        $em->flush();

        // $email = (new TemplatedEmail())
        // ->from('e.raffalli@hotmail.fr')
        // ->to(new Address($user->getEmail()))
        // ->subject('Merci pour votre participation!')
        // ->htmlTemplate('email/signup.html.twig')
        // ->locale('fr')
        // ->context([
        //     'username' => $user->getFirstName().' '.$user->getLastName(),
        // ]);

        // $mailer->send($email);
        // dd($user);

        return $this->redirectToRoute('app_success');
    }

    $pageTitle = [
        'app_won' => $translator->trans('pageTitle.app_won'),
        'app_lost' => $translator->trans('pageTitle.app_lost'),
        'app_answers' => $translator->trans('pageTitle.app_answers')
    ];

    // dd($pageTitle);

        return $this->render('quiz/template-quiz.html.twig', [
            'pageTitle' => $pageTitle,
            'participation' => $participation,
            'form' => $form->createView(),
            'errorMessage' => isset($errorMessage) ? $errorMessage : null,
            'allQuestions' => $allQuestions
        ]);
    }











}

