<?php 

class User{
    private $pdo;

    public function __construct($pdo) {
     $this->pdo = $pdo;
    }
/// function for login the user and admin
public function validateLogin($email, $password) {
        $sql = "SELECT id, name, type, password FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
        
    // function for registaration the user
       public function register($name, $email, $password) {
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        if (empty($name) || empty($email) || empty($password)) {
            die("All fields are required");
        }

        $sql = "INSERT INTO users (name, email, password, type) VALUES (:name, :email, :password, 'user')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'name' => $name, 
            'email' => $email, 
            'password' => $hash_password
        ]);

        return $this->pdo->lastInsertId();
    }
}