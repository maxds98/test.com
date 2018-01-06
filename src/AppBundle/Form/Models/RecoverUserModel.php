<?php
/**
 * Created by PhpStorm.
 * User: maxds
 * Date: 28.12.17
 * Time: 17:49
 */

namespace AppBundle\Form\Models;


class RecoverUserModel
{
    public $email;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}