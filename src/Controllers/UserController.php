<?php 

namespace PurpleStream\Controllers;

use PurpleStream\Models\UserManager;
use PurpleStream\Models\Profile;
use PurpleStream\Models\UserModel;

class UserController 
{
    private $userManager;

    public function __construct() 
    {
        $this->userManager = new UserManager();
    }

    public function create()
    {
        return header('Location: /login');
        // error 1 : password and confirm password are not the same
        // error 2 : email already exists

        // vérification du mot de passe de confirmation
        // if ($_POST['user_password'] != $_POST['user_confirm_password']) 
        // {
        //     header('Location: /register?error=1');
        //     exit();
        // }

        // // vérification de l'email
        // $email = strtolower(htmlspecialchars($_POST['user_email']));
        // $emailAlreadyUsed = $this->userManager->getUserByEmail($email);

        // if ($emailAlreadyUsed)
        // {
        //     return header('Location: /register?error=2');
        // }

        // $user = new UserModel();

        // $hashed_password = password_hash($_POST['user_password'], PASSWORD_BCRYPT);

        // $user->setUserName(htmlspecialchars($_POST['user_name']));
        // $user->setUserEmail($email);
        // $user->setUserPassword($hashed_password);

        // $this->userManager->create($user);

        // header('Location: /login?status=200');
    }

    public function login()
    {
        $email = strtolower(htmlspecialchars($_POST['user_email']));
        $password = htmlspecialchars($_POST['user_password']);

        $user = $this->userManager->getUserByEmail($email);

        if (!$user || !password_verify($password, $user['user_password']))
        {
            header('Location: /login?status=401');
            exit();
        }

        $_SESSION['user'] = array(
            'user_id' => $user['user_id'],
            'user_email' => $user['user_email'],
            'user_name' => $user['user_name'],
            'user_role' => $user['user_role']
        );

        header('Location: /home');
    }

    public function createProfil()
    {
        $random = "";
        $randomArray = ["random1.gif", "random2.png", "random3.gif"];
        $profil = new Profile();
        $id = $_SESSION["user"]["user_id"];
        $profil->setUserID($id);
        $profil->setProfilName(htmlspecialchars($_POST["name-profil"]));
        if (isset($_FILES['image-profil']) && $_FILES['image-profil']["error"] !== UPLOAD_ERR_NO_FILE) {
            $uploaddir = 'img/avatar/';
            $uploadfile = $uploaddir . basename($_FILES['image-profil']['name']);
            
            if (move_uploaded_file($_FILES['image-profil']['tmp_name'], $uploadfile)) {
                $profil->setProfilImage($_FILES['image-profil']['name']);
            } else {
                echo "Erreur lors du déplacement du fichier.";
            }
        } else {
            $profil->setProfilImage($random);
        }

        $saveProfil = $this->userManager->createProfil($profil);
    }

    public function Profil()
    {
        $id = $_SESSION["user"]["user_id"];
        $profils = $this->userManager->getProfils($id);

        require VIEWS . 'Profils.php';
    }

    public function modifyMail() 
    {
        $email = strtolower(htmlspecialchars($_POST['user_mail']));
        $emailAlreadyUsed = $this->userManager->getUserByEmail($email);

        if ($emailAlreadyUsed)
        {
            return header('Location: /user/change-user?error');
        }

        $this->userManager->modifyMail($_SESSION['user']['user_id'], $email);

        $_SESSION['user']['user_email'] = $email;

        header('Location: /user/change-user?success');
    }

    public function modifyPassword()
    {
        $actualyPassword = htmlspecialchars($_POST['actualy-password']);
        $newPassword = htmlspecialchars($_POST['new-password']);
        $newRePassword = htmlspecialchars($_POST['new-re-password']);

        $user = $this->userManager->getUserByEmail($_SESSION['user']['user_email']);

        if (!password_verify($actualyPassword, $user['user_password']))
        {
            header('Location: /user/change-user?error-password');
            exit();
        }

        if ($newPassword != $newRePassword)
        {
            header('Location: /user/change-user?error-new-password');
            exit();
        }

        $hashed_password = password_hash($newPassword, PASSWORD_BCRYPT);

        $this->userManager->modifyPassword($_SESSION['user']['user_id'], $hashed_password);

        header('Location: /user/change-user?success-modify-password');
    }

    public function showLoginForm() 
    {
        require VIEWS . 'FormLogin.php';
    }

    public function showModifyUser()
    {
        require VIEWS . 'ModifyAccount.php';
    }

    public function showAdminPanel()
    {
        require VIEWS . 'AdminPanel.php';
    }

    public function showCreateProfil()
    {
        require VIEWS . 'FormCreateProfil.php';
    }

    public function showRegisterForm()
    {
        require VIEWS . 'FormRegister.php';
    }

    function showProfils() {
        require VIEWS . "Account.php";         
    }

    public function logout()
    {
        session_destroy();
        header('Location: /login');
    }
}