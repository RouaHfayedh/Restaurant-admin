<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\User;
use App\Form\AccountType;
use App\Entity\PasswordUpdate;
use App\Form\RegistrationType;
use App\Form\PasswordUpdateType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminAccountController extends AbstractController
{
    /**
     * @Route("/admin/login", name="admin_account_login")
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();

        return $this->render('admin/account/login.html.twig', [

            'hasError'=>$error !==null,
            'username'=>$username
        ]);
    }

    /**
     * Permet d'afficher une page d'inscription
     * @Route("/admin/register",name="admin_account_register")
     *
     * @return Response
     */
    public function register(Request $request,UserPasswordEncoderInterface $encoder,ObjectManager $manager){

        $user = new User();

        $form = $this->createForm(RegistrationType::class,$user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $hash = $encoder->encodePassword($user,$user->getHash());

            // on modifie le mot de passe avec le setter

            $user->setHash($hash);

            $customer = \Stripe\Customer::create([
                'email' => $user->getEmail()
            ]);

            $manager->persist($user);
            $manager->flush();

            $this->addFlash("success","Votre compte a bien été créé");

            return $this->redirectToRoute("admin_account_login");

        }

        return $this->render("admin/account/register.html.twig",[
            'form'=>$form->createView()
        ]); 

    }

    /**
     * Permet la deconnexion de la partie admin
     * @Route("/admin/logout",name="admin_account_logout")
     * @return void
     */
    public function logout(){

    }
}
