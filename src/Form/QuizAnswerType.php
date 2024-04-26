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
                'label' => true,
                'attr'=> [
                    'class'=> 'w-100',
                    // 'data-target' => 'selectedAnswer'
                ],
                'choices' => $options['answers'], 
                'choice_label' => 'answer', 
                'choice_translation_domain' =>'messages',
                'expanded' => true,
                'multiple' => false, 
                'choice_attr' => function(){
                    return ['class' => 'inputChoice'];
                },
                // 'required' => true,            
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'action-buttons.next',
                'attr' => [
                    'class' => 'btn-delta mt-3 col-12 col-lg-4 mb-3'
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
