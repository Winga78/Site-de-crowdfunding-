<?php

namespace App\Form;

use App\Entity\Projet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
class CreateProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
       $builder
            ->add('titre' , TextType::class, ["label"=> false])
            ->add('description', TextareaType::class, ["label"=> false])
            ->add('budget', TextType::class, ["label"=> false])
            ->add('image', FileType::class, ["label"=> false])
			-> add('submit', SubmitType:: class, [
					'label' => "publier",
					'attr'=> [
						'class'=> 'btn w-100 btn-lg bg-light', 
						]
			])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}