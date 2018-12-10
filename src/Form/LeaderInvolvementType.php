<?php

namespace App\Form;

use App\Entity\LeaderInvolvement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LeaderInvolvementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', null, [
                'label' => 'leaderInvolvement.user'
            ])
            ->add('mentalCharge', null, [
                'label' => 'leaderInvolvement.mentalCharge'
            ])
            ->add('timeConsumator', null, [
                'label' => 'leaderInvolvement.timeConsumator'
            ])
            ->add('anxiety', null, [
                'label' => 'leaderInvolvement.anxiety'
            ])
            ->add('palatability', null, [
                'label' => 'leaderInvolvement.palatability'
            ])
            ->add('toughness', null, [
                'label' => 'leaderInvolvement.toughness'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LeaderInvolvement::class,
        ]);
    }
}
