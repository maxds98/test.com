<?php
/**
 * Created by PhpStorm.
 * User: maxds
 * Date: 28.12.17
 * Time: 18:23
 */

namespace AppBundle\Extend\Security;


use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RecoverPassword
{
    private $mailer;

    private $twig;

    private $em;

    private $router;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig, EntityManager $entity_manager, Router $router)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->em = $entity_manager;
        $this->router = $router;
    }

    /**
     * @param User $user
     * @return bool
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function send(User $user){
        $token = md5(uniqid(rand(), true));

        $url = $this->router->generate('recover', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL);
        $name = $user->getUsername();
        $template = $this->twig->render('MailTemplate/recover.html.twig', [
            'name' => $name,
            'url' => $url
        ]);

        $mail = \Swift_Message::newInstance();
        $mail->setFrom('Max_D_S@tut.by');
        $mail->setTo($user->getEmail());
        $mail->setSubject('Recover Password');
        $mail->setBody($template, 'text/html');

        $user->setTokenRecover($token);
        $this->em->persist($user);
        $this->em->flush();
        $status = $this->mailer->send($mail);
        if ($status){
            return true;
        } else {
            return false;
        }
    }
}