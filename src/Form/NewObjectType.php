<?php

namespace App\Form;

use App\Entity\Objet;
use App\Entity\Categories;
use App\Entity\CategoriesDetails;
use Symfony\Component\Form\AbstractType;
use App\Repository\CategoriesDetailsRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class NewObjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('status', ChoiceType::class, [
            'label' => "État",
            'choices' => [
                ' Objet perdu' => true,
                ' Objet Trouve' => false,
            ],
        ])
        ->add('category', EntityType::class, [
            'class' => Categories::class,
            'choice_label' => 'name',
            'label' => "choisir une categorie *",
            'placeholder' => "categorie ",
            'multiple'=>false // true si on peut choisir plusieurs catégories
            
        ])

        ->add('categoryDetails', EntityType::class, [
            'class' => CategoriesDetails::class,
            'choice_label' => 'name',
            'label' => "quoi excetemnt  *",
            'placeholder' => "sous categorie ",
            'query_builder' => function (CategoriesDetailsRepository $categoriesdetailsRepository) {
                return  $categoriesdetailsRepository->createQueryBuilder('categoriesdetails')
                    ->orderBy('categoriesdetails.id', 'ASC');
            }
        ])

            ->add('name')
       
            ->add('Lost_date',  DateType::class, [
                'placeholder' => [
                    'year' => 'Annee', 'month' => 'Mois', 'day' => 'Jour',

                ],
            ])

            ->add('image', FileType::class, [
                'label' => 'inserer l\'image dobjet ',
                
                'required' => false,
                 'multiple'=>false,
                 'data_class' => null,
                'constraints' => [
                    new File([
                        'maxSize' => '2024k',
                        'mimeTypes' => [
                            'image/gif', 'image/jpg', 'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image',
                    ])
                ],
            ])
            ->add('lost_adress')
            ->add('lost_city')
            ->add('lost_zip')
            ->add('description')
         
            ->add('clues')

          
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Objet::class,
        ]);
    }
}
