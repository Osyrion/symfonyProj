<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotNull;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotNull([
                        'message' => 'Email can not be blank',
                    ]),
                    new Email(),
                ]
            ])
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotNull(),
                ]
            ])
            ->add('password', TextType::class, [
                'constraints' => [
                    new NotNull(),
                ]
            ])
            // todo: roles not working properly - array type - input error: /validation
            ->add('roles', EntityType::class, [
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices' => [
                  'User' => 'ROLE_USER',
                  'Admin' => 'ROLE_ADMIN',
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
