<?php

namespace AppBundle\Component\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['required' => true, 'error_bubbling' => true])
            ->add('surname', TextType::class, ['required' => true, 'error_bubbling' => true])
            ->add('position', TextType::class, ['required' => true, 'error_bubbling' => true])
            ->add('gender', TextType::class, ['required' => true, 'error_bubbling' => true])
            ->add('office', TextType::class, ['required' => true, 'error_bubbling' => true])
            ->add('technology', TextType::class, ['required' => true, 'error_bubbling' => true]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return null;
    }
}
