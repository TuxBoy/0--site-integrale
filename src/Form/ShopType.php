<?php

namespace App\Form;

use App\Entity\Shop;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShopType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('street')
            ->add('postal_code')
            ->add('city')
            ->add('description')
            ->add('country')
            ->add('address')
            ->add('latitude', IntegerType::class, ['required' => false, 'attr' => ['disabled' => true]])
            ->add('longitude', IntegerType::class, ['required' => false, 'attr' => ['disabled' => true]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Shop::class,
        ]);
    }
}
