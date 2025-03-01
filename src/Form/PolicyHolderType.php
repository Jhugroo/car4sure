<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\PolicyHolder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PolicyHolderType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add(
                'address',
                AddressType::class,
            );
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => PolicyHolder::class,
        ]);
    }
}
