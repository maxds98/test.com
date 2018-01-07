<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Results;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ResultController extends Controller
{
    /**
     * @Route("/result", name="result")
     */
    public function resultAction()
    {
        $topResult = $this->getTopResults();
        $topUsers = $this->getTopUsers();

        return $this->render('Result/result.html.twig', array(
            'count' => $_GET['count'],
            'quiz' => $_GET['quiz'],
            'top' => $topResult,
            'user' => $topUsers,
        ));
    }

    private function getTopResults()
    {
        $repository = $this->getDoctrine()->getRepository(Results::class);
        $query = $repository->createQueryBuilder('p')->addOrderBy('p.result', 'DESC')->where('p.quizId ='.$_GET['quiz'])->getQuery();
        $result = $query->getArrayResult();

        return $result;
    }

    private function getTopUsers()
    {
        $repository = $this->getDoctrine()->getRepository(Results::class);
        $query = $repository->createQueryBuilder('p')->addOrderBy('p.result', 'DESC')->where('p.quizId ='.$_GET['quiz'])->getQuery();
        $result = $query->getArrayResult();

        $users = array();
        $em = $this->getDoctrine()->getManager();
        for ($i = 0; $i < count($result); $i++){
            $users[] = $em->getRepository('AppBundle:User')->find($result[$i]['userId'])->getUsername();
        }

        return $users;
    }

}
