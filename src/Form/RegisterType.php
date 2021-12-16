<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder // ce sont des inputs ci dessous
        ->add('firstname', TextType::class, [
            'label' => 'Votre prénom',  // l'import de TextType::class + le tableau juste aprés sert à rajouter différent parametre à notre form , ici pour changer le nom de notre label
            'attr' => [
                'placeholder' => 'Merci de saisir votre prénom'
            ]
        ])
        ->add('lastname', TextType::class, [
            'label' => 'Votre nom',
            'attr' => [
                'placeholder' => 'Merci de saisir votre nom'
            ]
        ])
        ->add('email', EmailType::class, [
            'label' => 'Votre Email',
            'attr' => [
                'placeholder' => 'Merci de saisir votre Email'
            ]
        ]) 
        // ->add('roles') en comm car on ne souhaite pas que l'utilisateur choissise son role
        ->add('password', PasswordType::class, [
            'label' => 'Votre Mot de passe',
            'attr' => [
                'placeholder' => 'Merci de saisir votre Mot de passe'
            ]
        ])
            ->add('password_confirm', PasswordType::class, [
                'label' => 'Confirmez Votre Mot de passe',
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Merci de confirmer votre Mot de passe'
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
