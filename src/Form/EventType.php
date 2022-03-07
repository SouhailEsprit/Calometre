<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;


class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('nom', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('dateDebut', TextType::class, [
                'attr' => ['class' => 'form-control','placeholder' => 'dd/mm/yyyy']
            ])
            ->add('dateFin', TextType::class, [
                'attr' => ['class' => 'form-control','placeholder' => 'dd/mm/yyyy']
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('nombreParticipants', NumberType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('lieu', TextType::class, [
                'attr' => ['class' => 'form-control']

            ])

            ->add('image', FileType::class, [
                'label' => "Image du Event",
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1200k',
                        'mimeTypes' => [
                            'application/pdf',
                            'image/jpeg',
                            'image/png'
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image ',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
