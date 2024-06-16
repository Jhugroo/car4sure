<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Vehicle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehicleType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('year')
            ->add('make')
            ->add('model')
            ->add('vin')
            ->add('usageVehicle')
            ->add('primaryUse')
            ->add('annualMileage')
            ->add('ownership')
            ->add('garagingAddress',  AddressType::class)
            ->add('coverages', CollectionType::class, [
                'entry_type' => CoverageType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => Vehicle::class,
        ]);
    }
}
