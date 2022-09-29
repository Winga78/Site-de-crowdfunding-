<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
			->add('nom', TextType::class, ["label"=> false] )
			->add('prenom', TextType::class, ["label"=> false])
            ->add('email',EmailType::class, ["label"=> false] )
            ->add('password',RepeatedType::class,[
			'type' => PasswordType::class,
			'invalid_message' => 'le mot de passe et la confirmation doivent être identitique.',
			'label'=> 'Votre mot de passe',
			'required'=> true,
			'first_options'=> ['label' => 'mot de passe', 
			'attr' => [ 
			'class'=> 'form-control',
			
			]
			],
			'second_options'=> [
				'label'=> 'Confirmez votre mot de passe',
				'attr' => [
				'class'=> 'form-control',
				] 
				]
			])
			
			-> add('submit', SubmitType:: class, [
					'label' => "S'inscrire",
					'attr'=> [
						'class'=> 'btn w-100 btn-lg bg-light', 
						]
			])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

