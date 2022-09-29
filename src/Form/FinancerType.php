<?php

namespace App\Form;

use App\Entity\Financer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FinancerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
             ->add('montant', TextType::class,["label"=> false])
            ->add('commentaire', TextareaType::class, ["label"=> false])
            -> add('financer', SubmitType:: class, [
					'attr'=> [
						'class'=> 'btn btn-outline-warning', 
						]
        ])
		
		;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Financer::class,
        ]);
    }
}

