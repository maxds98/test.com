<?php
/**
 * Created by PhpStorm.
 * User: maxds
 * Date: 05.01.18
 * Time: 18:26
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Results;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RatingController extends Controller
{
    /**
     * @Route("/setRating", name="setRating")
     */
    public function ratingControllerAction()
    {
        $this->setRating();
        return $this->redirectToRoute('result', array(
            'count' => $_GET['count'],
            'quiz' => $_GET['quiz'],
        ));
    }
    private function setRating()
    {
        /** @var User $user */
        $user = $this->getUser();
        $quiz_result = new Results();
        if($_GET['count']) {
            $em = $this->getDoctrine()->getManager();

            $count = $_GET['count'];

            $query = $this->getDoctrine()->getRepository('AppBundle:Results')->createQueryBuilder('p')
                ->update('AppBundle:Results', 'p')
                ->set('p.userId', $user->getId())
                ->set('p.quizId', $_GET['quiz'])
                ->set('p.result', $count)
                ->andWhere('p.quizId ='.$_GET['quiz'])
                ->andWhere('p.userId ='.$user->getId())
                ->getQuery()
                ->execute();

            if(!$query){
                $quiz_result->setUserId($user->getId());
                $quiz_result->setQuizId($_GET['quiz']);
                $quiz_result->setResult($count);
                $em->persist($quiz_result);
            }

            $rating = $user->getRating();
            $result = intval($rating) + $_GET['count'];
            $user->setRating($result);
            $em->persist($user);
            $em->flush();
        }
    }
}