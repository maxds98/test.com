<?php
/**
 * Created by PhpStorm.
 * User: maxds
 * Date: 05.01.18
 * Time: 18:26
 */

namespace AppBundle\Controller;

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
        return $this->redirectToRoute('homepage', array(
            'count' => $_GET['count'],
        ));
    }
    private function setRating()
    {
        /** @var User $user */
        $user = $this->getUser();
        if($_GET['count']) {
            $rating = $user->getRating();
            $result = intval($rating) + $_GET['count'];
            $user->setRating($result);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }
    }
}