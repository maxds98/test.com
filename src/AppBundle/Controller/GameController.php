<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Questions;
use AppBundle\Entity\Quizzes;
use AppBundle\Entity\Results;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class GameController extends Controller
{
    /**
     * @Route("/play")
     */
    public function playAction()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $quizzes = $this->getQuizzes($_GET['quiz']);
        for ($i = 0; $i < count($quizzes); $i++){
            $answers[$i] = $this->getAnswers($quizzes[$i]);
            $questions[$i] = $this->getQuestion($quizzes[$i]);
        }
        $topResult = $this->getTopResults();
        $topUsers = $this->getTopUsers();
            return $this->render('Game/play.html.twig', [
                'quiz' => $_GET['quiz'],
                'question' => $questions,
                'answer' => $answers,
                'top' => $topResult,
                'user' => $topUsers,
                'start' => time(),
            ]);
    }

    private function getTopResults()
    {
        $repository = $this->getDoctrine()->getRepository(Results::class);
        $query = $repository->createQueryBuilder('p')
            ->addOrderBy('p.result', 'DESC')
            ->where('p.quizId ='.$_GET['quiz'])
            ->getQuery();
        $result = $query->getArrayResult();

        return $result;
    }

    private function getTopUsers()
    {
        $repository = $this->getDoctrine()->getRepository(Results::class);
        $query = $repository->createQueryBuilder('p')
            ->addOrderBy('p.result', 'DESC')
            ->where('p.quizId ='.$_GET['quiz'])
            ->getQuery();
        $result = $query->getArrayResult();

        $users = array();
        $em = $this->getDoctrine()->getManager();
        for ($i = 0; $i < count($result); $i++){
            $users[] = $em->getRepository('AppBundle:User')
                ->find($result[$i]['userId'])
                ->getUsername();
        }

        return $users;
    }

    private function getQuery()
    {
        $repository = $this->getDoctrine()->getRepository(Questions::class);
        $query = $repository->createQueryBuilder('p')->getQuery();
        $result = $query->getArrayResult();
        return $result;
    }

    private function getQuestion($i)
    {
        $result = $this->getQuery();
        $question = $result[$i]['question'];
        return $question;
    }

    private function getAnswers($i)
    {
        $result = $this->getQuery();
        $answers[] = $result[$i]['answer1'];
        $answers[] = $result[$i]['answer2'];
        $answers[] = $result[$i]['answer3'];
        $answers[] = $result[$i]['answerTrue'];
        shuffle($answers);
        $answers[] = $result[$i]['answerTrue'];
        return $answers;
    }

    private function getQuizzes($quiz)
    {
        $repository = $this->getDoctrine()->getRepository(Quizzes::class);
        $query = $repository->createQueryBuilder('p')->getQuery();
        $result = $query->getArrayResult();
        $array = str_getcsv($result[$quiz]['questions']);
        return $array;
    }

}
