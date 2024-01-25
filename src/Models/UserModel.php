<?php 

namespace PurpleStream\Models;

class UserModel
{
    private $user_id;
    private $user_email;
    private $user_name;
    private $user_password;
    private $user_role;
    
    public function __construct()
    {

    }

    public function setAll($user_id, $user_email, $user_name, $user_password, $user_role)
    {
        $this->user_id = $user_id;
        $this->user_email = $user_email;
        $this->user_name = $user_name;
        $this->user_password = $user_password;
        $this->user_role = $user_role;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserEmail($user_email)
    {
        $this->user_email = $user_email;
    }

    public function getUserEmail()
    {
        return $this->user_email;
    }

    public function setUserName($user_name)
    {
        $this->user_name = $user_name;
    }

    public function getUserName()
    {
        return $this->user_name;
    }

    public function setUserPassword($user_password)
    {
        $this->user_password = $user_password;
    }

    public function getUserPassword()
    {
        return $this->user_password;
    }

    public function setUserRole($user_role)
    {
        $this->user_role = $user_role;
    }

    public function getUserRole()
    {
        return $this->user_role;
    }
}