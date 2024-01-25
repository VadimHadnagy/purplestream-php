<?php 

namespace PurpleStream\Models;

class UserManager
{
    private $connexion;

    public function __construct()
    {
        $this->connexion = new \PDO('mysql:host=' . DB_CONFIG['HOST'] . ';dbname='. DB_CONFIG['DATABASE'] .';charset=utf8', DB_CONFIG['USER'], DB_CONFIG['PASSWORD']);
    }

    public function create(UserModel $user)
    {
        $stmt = $this->connexion->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (:user_name, :user_email, :user_password)");
        $stmt->execute([
            'user_name' => $user->getUserName(),
            'user_email' => $user->getUserEmail(),
            'user_password' => $user->getUserPassword()
        ]);
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->connexion->prepare("SELECT * FROM users WHERE user_email = :user_email");
        $stmt->execute([
            'user_email' => $email
        ]);
        $result = $stmt->fetch();
        return $result;
    }

    public function modifyMail() 
    {
        $stmt = $this->connexion->prepare("UPDATE users SET user_email = :user_email WHERE user_id = :user_id");
        $stmt->execute([
            'user_email' => $_POST['user_mail'],
            'user_id' => $_SESSION['user']['user_id']
        ]);
    }

    public function getProfils($id) 
    {
        $stmt = $this->connexion->prepare('SELECT * FROM users_profiles WHERE user_id = :user_id');
        $stmt->execute([
            'user_id' => $id
        ]);

        $result = $stmt->fetchAll();
        return $result;
    }

    public function createProfil(Profile $profile)
    {
        $stmt = $this->connexion->prepare("INSERT INTO users_profiles (user_id, user_profilname, user_image) VALUE (:user_id, :user_profilname, :user_image)");
        $stmt->execute([
            'user_id' => $profile->getUserID(),
            'user_profilname' => $profile->getProfilName(),
            'user_image' => $profile->getProfilImage()
        ]);
    }

    public function modifyPassword() 
    {
        $stmt = $this->connexion->prepare("UPDATE users SET user_password = :user_password WHERE user_id = :user_id");
        $stmt->execute([
            'user_password' => password_hash($_POST['new-password'], PASSWORD_BCRYPT),
            'user_id' => $_SESSION['user']['user_id']
        ]);
    }
}