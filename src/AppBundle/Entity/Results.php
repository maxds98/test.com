<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Results
 *
 * @ORM\Table(name="results")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ResultsRepository")
 */
class Results
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
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="quiz_id", type="integer")
     * @ORM\OneToOne(targetEntity="Quizzes", mappedBy="id")
     */
    private $quizId;

    public function __construct()
    {
        $this->quizId = new ArrayCollection();
    }

    /**
     * @var int
     *
     * @ORM\Column(name="result", type="integer", nullable=true)
     */
    private $result;

    /**
     * @var int
     *
     * @ORM\Column(name="time", type="integer", nullable=true)
     */
    private $time;

    /**
     * @return int
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param int $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

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
     * Set userId
     *
     * @param integer $userId
     *
     * @return Results
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set quizId
     *
     * @param integer $quizId
     *
     * @return Results
     */
    public function setQuizId($quizId)
    {
        $this->quizId = $quizId;

        return $this;
    }

    /**
     * Get quizId
     *
     * @return int
     */
    public function getQuizId()
    {
        return $this->quizId;
    }

    /**
     * Set result
     *
     * @param integer $result
     *
     * @return Results
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get result
     *
     * @return int
     */
    public function getResult()
    {
        return $this->result;
    }
}
