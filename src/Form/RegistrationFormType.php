<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('username', TextType::class, [
        'attr' => [
          'class' => 'form-control',
        ], 'label' => 'Username',
        'label_attr' => [
          'class' => 'form-label'
        ],  'constraints' => [
          new Length(['min' => 3, 'max' => 55]),
          new NotBlank([
            'message' => 'Please enter your firstname',
          ]),

        ]
      ])
      ->add('firstname', TextType::class, [
        'attr' => [
          'class' => 'form-control',
        ], 'label' => 'Prénom',
        'label_attr' => [
          'class' => 'form-label'
        ],  'constraints' => [
          new Length(['min' => 3, 'max' => 55]),
          new NotBlank([
            'message' => 'Please enter your firstname',
          ]),

        ]
      ])
      ->add('lastname', TextType::class, [
        'attr' => [
          'class' => 'form-control',
        ], 'label' => 'Nom',
        'label_attr' => [
          'class' => 'form-label'
        ],  'constraints' => [
          new Length(['min' => 3, 'max' => 55]),
          new NotBlank([
            'message' => 'Please enter your lastname',
          ]),
        ]
      ])
      ->add('email', EmailType::class, [
        'constraints' => [
          new NotBlank([
            'message' => 'Please enter your email',
          ]),
          new Email([
            'message' => 'Please enter a valid email',
          ]),
        ],
        'help' => 'Nous vous envoyons une message de validation à cette adresse email.'
      ])
      ->add('plainPassword', PasswordType::class, [
        // instead of being set onto the object directly,
        // this is read and encoded in the controller
        'mapped' => false,
        'attr' => ['autocomplete' => 'new-password'],
        'constraints' => [
          new NotBlank([
            'message' => 'Please enter a password',
          ]),
          new Length([
            'min' => 6,
            'minMessage' => 'Your password should be at least {{ limit }} characters',
            // max length allowed by Symfony for security reasons
            'max' => 4096,
          ]),
        ],
      ])
      ->add('agreeTerms', CheckboxType::class, [

        'mapped' => false,
        'constraints' => [
          new IsTrue([
            'message' => 'You should agree to our terms.',
          ]),
        ],
      ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Users::class,
    ]);
  }
}
