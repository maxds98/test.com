<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TopController extends Controller
{
    /**
     * @Route("/top", name="top")
     */
    public function topAction()
    {
        $user = $this->getUsers();
        return $this->render('Top/top.html.twig', array(
            'top' => $user,
        ));
    }

    private function getUsers()
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $query = $repository->createQueryBuilder('p')->addOrderBy('p.rating', 'DESC')->getQuery();
        $user = $query->getArrayResult();
        return $user;
    }

}
