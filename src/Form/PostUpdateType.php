<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Post;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description', CKEditorType::class,[
                'config'=>[
                    'uiColor'=> '#AADC6E',
                    'toolbar'=> 'full',
                    'required'=> true
                ]
            ])
            ->add('attachment', FileType::class,[
                'mapped'=> false
            ])
//            ->add('category', EntityType::class,[
//                'class'=> Category::class,
//                'mapped'=> false
//            ])
            ->add('Update',SubmitType::class,[
                'attr'=>[
                    'class'=>'btn btn-primary float-right'
                ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
