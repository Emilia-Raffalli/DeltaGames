<?php

namespace App\Form;

use App\Entity\Answer;
use App\Entity\Participation;
use App\Entity\Question;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuizAnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('answer', ChoiceType::class, [
                'label' => false,
                'attr'=> [
                    'class'=> 'w-100',
                    // 'data-target' => 'selectedAnswer'
                ],
                'choices' => $options['answers'], 
                'choice_label' => 'answer', 
                'choice_translation_domain' =>'messages',
                'expanded' => true, // bouton radio
                'multiple' => false, 
                // 'required' => true,

            
            ])
            // ->add('question', TextType::class, [
            //     'label' => false,
            //     'choices' => $options['answers'], 
            //     'choice_label' => 'answer', 
            //     'expanded' => true, // bouton radio
            //     'multiple' => false, 
            //     'required' => true, 
            // ])
            ->add('submit', SubmitType::class, [
                'label' => 'action-buttons.next',
                'attr' => [
                    'class' => 'btn-delta text-white btn border-2 bg-delta-red fw-bold border-white rounded-5 px-5 fs-4'
                ]
            ])
            ->setAttribute('answer_translation_keys', $options['answer_translation_keys']);
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Answer::class, 
            'answers' => [], 
            'answer_translation_keys' => [],
        ]);
    }
}
