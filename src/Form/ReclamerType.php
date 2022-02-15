<?php

namespace App\Form;

use App\Entity\Reclamer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ReclamerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idreclamation')
            ->add('type',ChoiceType::class,['choices'=>['food'=>'food','exercice'=>'exercice','coach'=>'coach,'],])
            ->add('message')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reclamer::class,
        ]);
    }
}
