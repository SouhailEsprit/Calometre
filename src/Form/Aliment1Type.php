<?php

namespace App\Form;

use App\Entity\Aliment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Aliment1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('Categorie', ChoiceType::class,
               [ 'choices'=> [

        'Viandes'=>'Viandes','Poisson'=>'Poisson','Oeufs'=>'Oeufs','Produits laitiers'=>'Produits laitiers','Matières grasses'=>'Matières grasses','légumes et fruits'=>'légumes et fruits',
        'Céréales et dérivés'=>'Céréales et dérivés','Légumineuses'=>'Légumineuses','Sucres et Produits sucrés'=>'Sucres et Produits sucrés','Boissons'=>'Boissons'
         ],])


            ->add('calories')
            ->add('Listerecette');

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Aliment::class,
        ]);
    }
}
