<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'email',
                'attr' => [
                    'placeholder' => 'Add your email'
                ],
                'constraints' => [
                    new NotBlank(),
                    new Email(),
                    new Length([
                        'max' => 30,
                        'maxMessage' => 'Your email cannot be longer than {{ limit }} characters'
                    ])
                ],
            ])
            ->add('login', TextType::class, [
                'label' => 'login',
                'attr' => [
                    'placeholder' => 'Create your login'
                ],
                'constraints' => [
                    new NotBlank(),
                    new Regex([
                        'pattern' => '/^[A-Za-zА-Яа-яЁё\s]{2,50}$/u',
                        'message' => 'Your login has to contain only letters'
                    ]),
                    new Length([
                        'min' => 2,
                        'max' => 50,
                        'minMessage' => 'Your login must be at least {{ limit }} characters long',
                        'maxMessage' => 'Your login cannot be longer than {{ limit }} characters'
                    ])
                ],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => [
                    'label' => 'password',
                    'attr' => [
                        'placeholder' => 'Create your password'
                    ],
                    'constraints' => [
                        new NotBlank(),
                        new Regex([
                            'pattern' => '/\d/',
                            'message' => 'Your password should contain at least 1 number'
                        ]),
                        new Length([
                            'min' => 8,
                            'max' => 255,
                            'minMessage' => 'Your password must be at least {{ limit }} characters long',
                            'maxMessage' => 'Your password cannot be longer than {{ limit }} characters'
                        ])
                    ],
                ],
                'second_options' => [
                    'label' => 'repeat password',
                    'attr' => [
                        'placeholder' => 'Repeat your password'
                    ],
                    'constraints' => [
                        new NotBlank(),
                    ],
                ],
            ])
            ->add('avatarId', FileType::class, [
                'label' => 'Choose photo',
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new Image([
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/jpg'],
                        'maxSize' => 5 * 1024 * 1024
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
