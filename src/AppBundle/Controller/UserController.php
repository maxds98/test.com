<?php

namespace AppBundle\Controller;

use AppBundle\Form\ChangePasswordForm;
use AppBundle\Form\Models\ChangePasswordModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/recover/password")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function recoverPasswordAction(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();
        if (!$user->getTokenRecover()){
            return $this->redirectToRoute('logout');
        }

        $changePasswordModel = new ChangePasswordModel();
        $formChangePassword = $this->createForm(ChangePasswordForm::class, $changePasswordModel);
        $formChangePassword->handleRequest($request);
        if ($formChangePassword->isSubmitted() && $formChangePassword->isValid()){
            $encoder = $this->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $changePasswordModel->password);
            $user->setPassword($password);
            $user->setTokenRecover(null);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('logout');

        }
        return $this->render('User/recover_password.html.twig', array(
            'recover_form' => $formChangePassword->createView()
        ));
    }

}
