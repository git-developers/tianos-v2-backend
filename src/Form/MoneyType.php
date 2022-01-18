<?php

namespace App\Form;

use App\Entity\Money;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MoneyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('realValue', ChoiceType::class, [
                'choices' => Money::REAL_VALUE,
                'error_bubbling' => false,
            ])
            ->add('currency', ChoiceType::class, [
                'choices' => Money::CURRENCY,
                'error_bubbling' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Money::class,
        ]);
    }
}
