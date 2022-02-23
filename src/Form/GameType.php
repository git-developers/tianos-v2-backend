<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\User;
use App\Entity\CardPattern;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['class' => ''],
                'error_bubbling' => false,
            ])
            ->add('cardPattern', EntityType::class, [
                'label' => 'Card Pattern',
                'class' => CardPattern::class,
                'choice_label' => function ($cardPattern) {
                    return $cardPattern->getName();
                },
                'required'    => true,
                'placeholder' => '[ Choose Pattern ]',
                'empty_data'  => null,
                'error_bubbling' => false,
            ])
            ->add('users', EntityType::class, [
                'label' => 'Players',
                'class' => User::class,
                'multiple' => false,
                'expanded' => true,
                'choice_label' => function ($user) {
                    return $user->getName();
                },
                'error_bubbling' => false,
            ])
            ->add('cardNumber', ChoiceType::class, [
                'choices' => [
                    '1-75' => Game::NUMBERS_75,
                ],
                'error_bubbling' => false,
            ])
            ->add('maxCard', ChoiceType::class, [
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                ],
                'error_bubbling' => false,
            ])
            ->add('maxCard', ChoiceType::class, [
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                ],
                'error_bubbling' => false,
            ])
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event)  {
            $data = $event->getData();
            $form = $event->getForm();

            if (null != $data->getId()) {
                $form->add('status', ChoiceType::class, [
                    'choices' => [
                        Game::STATUS_CREATED => Game::STATUS_CREATED,
                        Game::STATUS_OPEN => Game::STATUS_OPEN,
                        Game::STATUS_CLOSED => Game::STATUS_CLOSED,
                    ],
                    'required'    => true,
                    'placeholder' => '[ Choose status ]',
                    'empty_data'  => null,
                    'error_bubbling' => true,
                ]);
            }

        });

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event)  {
            $data = $event->getData();
            $form = $event->getForm();

        });

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
