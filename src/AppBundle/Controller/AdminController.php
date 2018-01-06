<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Questions;
use AppBundle\Entity\Quizzes;
use AppBundle\Form\QuestionType;
use AppBundle\Form\QuizzesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @Route("/admin")
     */
    public function adminAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');
        return $this->render('Admin/admin.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/admin/questions", name="questions")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function questionsAction(Request $request)
    {
        $questions = $this->getQuestions();
        $em = $this->getDoctrine()->getManager();

        $question = new Questions();

        $form = $this->createForm(QuestionType::class, $question);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $question = $form->getData();
            $em->persist($question);
            $em->flush();
            return $this->redirectToRoute('questions');
        }

        return $this->render('Admin/questions.html.twig', array(
            'questions' => $questions,
            'form' => $form->createView(),
        ));
    }

    private function getQuestions()
    {
        $repository = $this->getDoctrine()->getRepository(Questions::class);
        $query = $repository->createQueryBuilder('p')->getQuery();
        $result = $query->getArrayResult();
        return $result;
    }


    /**
     * @Route("/admin/quizzes", name="quizzes")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function quizzesAction(Request $request)
    {
        $quizzes = $this->getQuizzes();
        $questions = $this->getQuestions();
        $em = $this->getDoctrine()->getManager();

        $quiz = new Quizzes();

        $form = $this->createForm(QuizzesType::class, $quiz);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $quiz = $form->getData();
            $em->persist($quiz);
            $em->flush();
            return $this->redirectToRoute('quizzes');
        }

        return $this->render('Admin/quizzes.html.twig', array(
            'quizzes' => $quizzes,
            'questions' => $questions,
            'form' => $form->createView(),
        ));
    }

    private function getQuizzes()
    {
        $repository = $this->getDoctrine()->getRepository(Quizzes::class);
        $query = $repository->createQueryBuilder('p')->getQuery();
        $result = $query->getArrayResult();
        return $result;
    }

}
