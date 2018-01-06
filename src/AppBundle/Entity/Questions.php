<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Questions
 *
 * @ORM\Table(name="questions")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuestionsRepository")
 */
class Questions
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=255)
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="answer1", type="string", length=255)
     */
    private $answer1;

    /**
     * @var string
     *
     * @ORM\Column(name="answer2", type="string", length=255)
     */
    private $answer2;

    /**
     * @var string
     *
     * @ORM\Column(name="answer3", type="string", length=255)
     */
    private $answer3;

    /**
     * @var string
     *
     * @ORM\Column(name="answer_true", type="string", length=255)
     */
    private $answerTrue;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set question
     *
     * @param string $question
     *
     * @return Questions
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set answer1
     *
     * @param string $answer1
     *
     * @return Questions
     */
    public function setAnswer1($answer1)
    {
        $this->answer1 = $answer1;

        return $this;
    }

    /**
     * Get answer1
     *
     * @return string
     */
    public function getAnswer1()
    {
        return $this->answer1;
    }

    /**
     * Set answer2
     *
     * @param string $answer2
     *
     * @return Questions
     */
    public function setAnswer2($answer2)
    {
        $this->answer2 = $answer2;

        return $this;
    }

    /**
     * Get answer2
     *
     * @return string
     */
    public function getAnswer2()
    {
        return $this->answer2;
    }

    /**
     * Set answer3
     *
     * @param string $answer3
     *
     * @return Questions
     */
    public function setAnswer3($answer3)
    {
        $this->answer3 = $answer3;

        return $this;
    }

    /**
     * Get answer3
     *
     * @return string
     */
    public function getAnswer3()
    {
        return $this->answer3;
    }

    /**
     * Set answerTrue
     *
     * @param string $answerTrue
     *
     * @return Questions
     */
    public function setAnswerTrue($answerTrue)
    {
        $this->answerTrue = $answerTrue;

        return $this;
    }

    /**
     * Get answerTrue
     *
     * @return string
     */
    public function getAnswerTrue()
    {
        return $this->answerTrue;
    }
}

