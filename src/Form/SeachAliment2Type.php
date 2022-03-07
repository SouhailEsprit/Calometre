<?php

namespace App\Form;

use App\Entity\Aliment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeachAliment2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('query', ChoiceType::class,
                [ 'choices'=> [

                    'Viandes'=>'Viandes','Poisson'=>'Poisson','Oeufs'=>'Oeufs','Produits laitiers'=>'Produits laitiers','Matières grasses'=>'Matières grasses','légumes et fruits'=>'légumes et fruits',
                    'Céréales et dérivés'=>'Céréales et dérivés','Légumineuses'=>'Légumineuses','Sucres et Produits sucrés'=>'Sucres et Produits sucrés','Boissons'=>'Boissons'
                ],'label'=>"Recherche par catégorie"])
            ->add('recherche', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Aliment::class,
        ]);
    }
}
