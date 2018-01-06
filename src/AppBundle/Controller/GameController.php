<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Questions;
use AppBundle\Entity\Quizzes;
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

            return $this->render('Game/play.html.twig', [
                'question' => $questions,
                'answer' => $answers,
            ]);
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
