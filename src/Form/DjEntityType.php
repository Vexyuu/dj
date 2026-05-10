<?php

namespace App\Form;

use App\Entity\DjEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;

class DjEntityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom')
            ->add('Prenom')
            ->add('Email')
            ->add('Tel')
            ->add('UrlPortfolio')
            ->add('DateSoiree')
            ->add('Materiel')
            ->add('Couleur', ColorType::class)
            ->add('Photo', FileType::class, [
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new NotBlank(
                        message: 'La photo est obligatoire.'
                    ),
                    new Image(
                        maxSize: '5M',
                        mimeTypesMessage: 'Veuillez uploader une image valide (JPEG, PNG, etc.)'
                    )
                ],
            ])
            ->add('NbEnceintes')
            ->add('Puissance')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DjEntity::class,
        ]);
    }
}
