<?php

namespace App\Form;

use App\Entity\Money;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Validator\DuplicateUser;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',
                EmailType::class, [
                'attr' => ['placeholder' => 'Your email address'],
                'constraints' => [
                    new NotBlank(["message" => "Please provide a valid email"]),
                    new Email(["message" => "Your email doesn't seems to be valid"]),
                ],
                'error_bubbling' => false,
                //'constraints' => array(new DuplicateUser()),
            ])
            ->add('name')
            ->add('lastName')
            ->add('phone')
            ->add('address')
            ->add('notes')
            ->add('money', EntityType::class, [
                'label' => 'Card Pattern',
                'class' => Money::class,
                'choice_label' => function ($money) {
                    return $money->getName();
                },
                'required'    => true,
                'placeholder' => '[ Choose Money ]',
                'empty_data'  => null,
                'error_bubbling' => false,
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    User::ROLE_TIANOS => User::ROLE_TIANOS,
                ],
                'multiple' => true,
                'error_bubbling' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_protection' => false,
        ]);
    }
}
