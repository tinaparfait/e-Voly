<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Disease;
use App\Entity\Season;
use App\Entity\Vegetable;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class VegetableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('scientificName')
            ->add('description')
            ->add('difficulty')
            ->add('image', FileType::class, [
                'label' => 'Télécharger un image',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Assert\File(
                        maxSize: '1024k',
                        extensions: ['jpg', 'jpeg', 'png', 'webp'],
                        extensionsMessage: 'Veuillez télécharger une image valide (JPG, PNG, WebP)',
                    )
                ]
            ])
            ->add('soilType')
            ->add('sunlight')
            ->add('watering')
            ->add('germinationDays')
            ->add('harvestDays')
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
            ])
            ->add('diseases', EntityType::class, [
                'class' => Disease::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('seasons', EntityType::class, [
                'class' => Season::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Ajouter',
                'attr' => ['class' => 'btn btn-primary']
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vegetable::class,
        ]);
    }
}
