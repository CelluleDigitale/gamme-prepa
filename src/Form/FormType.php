<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;

class FormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
    
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'mapped' => false,
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'mapped' => false,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'mapped' => false,
            ])
            ->add('phone', TelType::class, [
                'label' => 'Téléphone',
                'mapped' => false,
            ])
            ->add('sites', ChoiceType::class, [
                'label' => 'Centres',
                'mapped' => false,
                'choices' => [
                    'Brest' => 'Brest',
                    'Pont-de-Buis' => 'Pont-de-Buis',
                    'Landerneau' => 'Landerneau',
                    'Concarneau' => 'Concarneau',
                    'Douarnenez' => 'Douarnenez',
                    'Pont l\'Abbé' => 'Pont l\'Abbé',
                    'Lorient' =>'Lorient',
                    'Quimperlé' =>'Quimperlé',               ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Continue'
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'method' => 'POST',
            'csrf_protection' => false,
        ]);
    }
}
