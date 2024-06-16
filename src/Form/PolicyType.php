<?php

namespace App\Form;

use App\Entity\Driver;
use App\Entity\Policy;
use App\Entity\Vehicle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PolicyType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('policyNo')
            ->add('policyStatus')
            ->add('policyType')
            ->add('policyEffectiveDate', null, [
                'widget' => 'single_text',
            ])
            ->add('policyExpirationDate', null, [
                'widget' => 'single_text',
            ])
            ->add('policyHolder', PolicyHolderType::class)
            ->add('drivers', EntityType::class, [
                'class' => Driver::class,
                'placeholder' => 'Pick drivers',
                'choice_label' => 'firstName',
                'by_reference' => false,
                'multiple' => true,
            ])
            ->add('vehicles', EntityType::class, [
                'class' => Vehicle::class,
                'placeholder' => 'Pick vehicles',
                'choice_label' => function (Vehicle $vehicle): string {
                    return $vehicle->getModel() . ' ' . $vehicle->getMake() . ' ' . $vehicle->getYear();
                },
                'by_reference' => false,
                'multiple' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => Policy::class,
        ]);
    }
}
