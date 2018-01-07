<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Quizzes;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomepageController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepageAction()
    {
        return $this->render('Homepage/homepage.html.twig', array(
            //...
        ));
    }
}
