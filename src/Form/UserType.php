<?php

namespace App\Form;

use App\Entity\Participation;
use App\Entity\User;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TypeTextType::class, [
                'label'=> false,
                'attr' => [
                    'placeholder' => 'userForm.firstName',
                    'class' => 'form-control border-0 form-delta'
                ]
            ])
            ->add('lastName', TypeTextType::class, [
                'label'=> false,
                'attr' => [
                    'placeholder' => 'userForm.lastName',
                    'class' => 'form-control border-0 form-delta'
                ]
            ])
            ->add('email', EmailType::class, [
                'label'=> false,
                'attr' => [
                    'placeholder' => 'userForm.email',
                    'class' => 'form-control border-0 form-delta'
                ]
            ])
            ->add('adress', TypeTextType::class, [
                'label'=> false,
                'attr' => [
                    'placeholder' => 'userForm.adress',
                    'class' => 'form-control border-0 form-delta'
                ]
            ])     
            ->add('adress2', TypeTextType::class, [
                'label'=> false,
                'required' => false,
                'attr' => [
                    'placeholder' => "userForm.adress2",
                    'class' => 'form-control border-0 form-delta'
                ]
            ])    
            ->add('zipCode', TypeTextType::class, [
                'label'=> false,
                'attr' => [
                    'placeholder' => "userForm.zipCode",
                    'class' => 'form-control border-0 form-delta'
                ]
            ])
            ->add('city', TypeTextType::class, [
                'label'=> false,
                'attr' => [
                    'placeholder' => "userForm.city",
                    'class' => 'form-control border-0 form-delta'
                ]
            ])
            ->add('country', TypeTextType::class, [
                'label'=> false,
                'attr' => [
                    'placeholder' => "userForm.country",
                    'class' => 'form-control border-0 form-delta'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'action-buttons.confirm',
                'attr' => [
                    'class' => 'btn-delta mt-3 col-12 col-lg-5'
                ]
            ]);
// //             ->add('participation', EntityType::class, [
// //                 'class' => Participation::class,
// // 'choice_label' => 'id',
//             ]
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
