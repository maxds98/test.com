<?php

namespace AppBundle\Controller;

use AppBundle\Form\Models\RecoverUserModel;
use AppBundle\Form\RecoverUserForm;
use Doctrine\ORM\OptimisticLockException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class RecoverController extends Controller
{
    public function recoverAction(Request $request, $token)
    {
        if ($token){
            $user = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(array('tokenRecover'=>$token));
            $userPasswordToken = new UsernamePasswordToken($user, null, 'main', array('IS_AUTHENTICATED_FULLY'));
            $this->get('security.token_storage')->setToken($userPasswordToken);
            return $this->redirectToRoute('recoverPassword');
        }
        $error = '';
        $recoverModel = new RecoverUserModel();
        $recoverForm = $this->createForm(RecoverUserForm::class, $recoverModel);
        $recoverForm->handleRequest($request);
        if ($recoverForm->isSubmitted()){
            $email = $recoverModel->getEmail();
            $user = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(array('email'=>$email));
            if ($user){
                try {
                    $this->get('user.security.recover')->send($user);
                } catch (OptimisticLockException $e) {
                } catch (\Twig_Error_Loader $e) {
                } catch (\Twig_Error_Runtime $e) {
                } catch (\Twig_Error_Syntax $e) {
                }
            } else {
                $error = 'No user with this email!';
            }

            var_dump('message send');
        }
        return $this->render('Recover/recover.html.twig', array(
            'recover_form' => $recoverForm->createView(),
            'error' => $error,
        ));
    }

}
