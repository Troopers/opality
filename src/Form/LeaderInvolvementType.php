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
            ->add('mentalCharge', null, [
                'label' => 'form.leaderInvolvement.mentalCharge'
            ])
            ->add('timeConsumator', null, [
                'label' => 'form.leaderInvolvement.timeConsumator'
            ])
            ->add('anxiety', null, [
                'label' => 'form.leaderInvolvement.anxiety'
            ])
            ->add('palatability', null, [
                'label' => 'form.leaderInvolvement.palatability'
            ])
            ->add('toughness', null, [
                'label' => 'form.leaderInvolvement.toughness'
            ])
            ->add('user', null, [
                'label' => 'form.leaderInvolvement.user'
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
