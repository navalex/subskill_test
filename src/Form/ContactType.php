<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civility', ChoiceType::class, [
                'choices'  => [
                    'contact.form.civility_male' => 'Mr.',
                    'contact.form.civility_female' => 'M.',
                ],
                'multiple' => false,
                'label' => 'contact.form.civility'
            ])
            ->add('first_name', TextType::class, [
                'label' => 'contact.form.first_name'
            ])
            ->add('last_name', TextType::class, [
                'label' => 'contact.form.last_name'
            ])
            ->add('from', EmailType::class, [
                'label' => 'contact.form.from'
            ])
            ->add('subject', TextType::class, [
                'label' => 'contact.form.subject'
            ])
            ->add('content', TextareaType::class, [
                'label' => 'contact.form.content'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
