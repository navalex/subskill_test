<?php

namespace App\Form;

use App\Entity\PostArticle;
use App\Entity\PostCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
                'label' => 'post.crud.form.title'
            ])
            ->add('description', null, [
                    'label' => 'post.crud.form.description'
            ])
            ->add('image', null, [
                'label' => 'post.crud.form.image'
            ])
            ->add('category', EntityType::class, [
                'class' => PostCategory::class,
                'label' => 'post.crud.form.category'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PostArticle::class,
        ]);
    }
}
