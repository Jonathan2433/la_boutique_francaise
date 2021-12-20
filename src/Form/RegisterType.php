<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder // ce sont des inputs ci dessous
        ->add('firstname', TextType::class, [
            // l'import de TextType::class + le tableau juste aprés sert à rajouter différent parametre à notre form , ici pour changer le nom de notre label
            'label' => 'Votre prénom',
            // ajout de contraintes, ici le nombre minimum et maximum de caractere
            'constraints
            ' =>  new Length([
                'min' => 2,
                'max' => 50
                ]
            ),
            'attr' => [
                'placeholder' => 'Merci de saisir votre prénom'
            ]
        ])
        ->add('lastname', TextType::class, [
            'label' => 'Votre nom',
            'constraints' =>  new
            Length(
                [
                    'min' => 2,
                    'max' => 50
                ]
            ),
            'attr' => [
                'placeholder' => 'Merci de saisir votre nom'
            ]
        ])
        ->add('email', EmailType::class, [
            'label' => 'Votre Email',
            'constraints' =>  new
            Length(
                [
                    'min' => 2,
                    'max' => 50
                ]
            ),

            'attr' => [
                'placeholder' => 'Merci de saisir votre Email'
            ]
        ]) 
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            // message d'erreur lorsque les champs ne sont pas identique
            'invalid_message' => 'le mot de passe ne correspond pas',
            'required' => true,
            'first_options' => [
                'label' => 'Mot de Passe',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre Mot de passe'
                ]
            ],
            'second_options' => [ 
                'label' => 'Confirmez votre mot de passe',
                'attr' => [
                    'placeholder' => 'Merci de confirmer votre Mot de passe'
                ]
            ]
        ])
        ->add('submit', SubmitType::class, [
            'label' => "S'inscire",
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
