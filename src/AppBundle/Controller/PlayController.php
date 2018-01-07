<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Quizzes;
use AppBundle\Entity\Results;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PlayController extends Controller
{
    /**
     * @Route("/quizzes", name="quizzes_list")
     */
    public function quizzesAction()
    {
        $quizzes = $this->getQuizzes();
        $users = $this->getTopUsers();

        return $this->render('Play/quizzes.html.twig', array(
            'quizzes' => $quizzes,
            'top_user' => $users,
        ));
    }

    private function getQuizzes()
    {
        $repository = $this->getDoctrine()->getRepository(Quizzes::class);
        $query = $repository->createQueryBuilder('p')->getQuery();
        $result = $query->getArrayResult();
        return $result;
    }

    private function getTopUsers()
    {
        $quizzes = $this->getQuizzes();
        $repository = $this->getDoctrine()->getRepository(Results::class);

        $result = array();

        for($j = 0; $j < count($quizzes); $j++){
            $query = $repository->createQueryBuilder('p')->addOrderBy('p.result', 'DESC')->where('p.quizId ='.$j)->getQuery();
            $result[] = $query->getArrayResult();
        }

        $users = array();
        $em = $this->getDoctrine()->getManager();
        for ($i = 0; $i < count($result); $i++){
            if(count($result[$i]) > 0) {
                $users[] = $em->getRepository('AppBundle:User')->find($result[$i][0]['userId'])->getUsername();
            } else {
                $users[] = '';
            }
        }
        return $users;
    }
}
