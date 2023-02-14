<?php

namespace App\Form;

use App\Entity\Users;
use App\Entity\Messages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class MatchingMessagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('title', TextType::class, [
                "attr" => [
                   
                ]
            ])
            
            ->add('message', TextareaType::class, [
                "attr" => [
                   
                ]
                ])

                ->add('image', FileType::class, [
                    'label' => 'inserer l\'image dobjet ',
    
                    'required' => false,
                   // 'multiple'=>true,
                    'constraints' => [
                        new File([
                            'maxSize' => '2024k',
                            'mimeTypes' => [
                            'image/gif','image/jpg','image/jpeg', ],
                            'mimeTypesMessage' => 'Please upload a valid image',])
                    ],
                ]);
     }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Messages::class,
        ]);
    }
}
