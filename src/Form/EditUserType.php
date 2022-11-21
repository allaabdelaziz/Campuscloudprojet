<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EditUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            
            ->add('civilite', ChoiceType::class, [
                'choices'  => [
                    ''=>'',
                    'Madame' => "madame",
                    'Monsieur' => "monsieur"
                ],
            ]) 
            ->add('secondname')
            ->add('firstname')
            ->add('address')
            ->add('zipcode')
            ->add('city')
            ->add('phone')
            
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
