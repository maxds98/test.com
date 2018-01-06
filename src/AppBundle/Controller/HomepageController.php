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
        $user = $this->getUsers();
        $quizzes = $this->getQuizzes();
        return $this->render('Homepage/homepage.html.twig', array(
            'top' => $user,
            'quizzes' => $quizzes,
        ));
    }

    private function getQuizzes()
    {
        $repository = $this->getDoctrine()->getRepository(Quizzes::class);
        $query = $repository->createQueryBuilder('p')->getQuery();
        $result = $query->getArrayResult();
        return $result;
    }

    private function getUsers()
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $query = $repository->createQueryBuilder('p')->addOrderBy('p.rating', 'DESC')->getQuery();
        $user = $query->getArrayResult();
        return $user;
    }
}
