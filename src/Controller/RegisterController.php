<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    // integre doctrine sous la variable $entityManager
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/inscription", name="register")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        // on utilise le parametre UserPasswordEncoderInterface pour utiliser notre methode d'encryptage de mot de passe 
        $user = new User();
        // création du formulaire
        $form = $this->createForm(RegisterType::class, $user);

        // récupération du l'objet request au formulaire
        $form->handleRequest($request);

        //  si le formulaire es soumis et validé 
        if ($form->isSubmitted() && $form->isValid()) {
            // on récupére la data du form
            $user = $form->getData();

            // encodage du mot de passe que l'on recupere grace au geter
            $password = $encoder->encodePassword($user, $user->getPassword());
            
            // envoi du mot de passe crypter grace au seter
            $user->setPassword($password);

            // ON ENVOIE la data en bdd
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }
    
        return $this->render('register/index.html.twig', [
            'controller_name' => 'RegisterController',
            // on créer la vue du formulaire
            'form' => $form->createView()
        ]);
    }
}
