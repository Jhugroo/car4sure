<?php

namespace App\Form;

use App\Entity\Driver;
use App\Entity\Gender;
use App\Entity\MaritalStatus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DriverType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('age')
            ->add('licenseNumber')
            ->add('licenseState')
            ->add('licenseEffectiveDate', null, [
                'widget' => 'single_text',
            ])
            ->add('licenseExpirationDate', null, [
                'widget' => 'single_text',
            ])
            ->add('licenseClass')
            ->add('gender', EntityType::class, [
                'class' => Gender::class,
                'placeholder' => 'Pick your gender',
                'choice_label' => 'name',
            ])
            ->add('maritalStatus', EntityType::class, [
                'class' => MaritalStatus::class,
                'placeholder' => 'Pick marital status',
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => Driver::class,
        ]);
    }
}
