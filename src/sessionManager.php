<?php
/**Jeronimo Martinez Barragan
 * CSC 390 
 * Project 4: Database Interaction and AJAX
 */
// Handles login logic
// Connect to database
require_once 'database.php';

class sessionManager {

    // Keep pdo inside the scope of the class
    private $pdo;
    private $userId;

    // pdo constructor
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }


    //Check if user is logged in
    public function isLoggedIn(){
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            return true;
        } else {
            return false;
        }   
    }

    // Authenticate user credentials
    public function authenticate($username, $password){
        // Look user up
        $query = $this->pdo->prepare("SELECT * FROM user WHERE name = :name");
        $query->bindValue(':name', $username);
        $query->execute();

        // Fetch results as an array
        $user = $query->fetch(PDO::FETCH_ASSOC);

        //  Check user exists
        if (!$user) {
            return false;
        }

        // Check password and store user ID
        if (password_verify($password, $user['password_hash'])) {
            $this->userId = $user['user_id'];
            return true;
        } else {
            return false;
        }
    }

    // Log user in and create the session
    public function logUserIn($username){
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $this->userId;
    
    }

    // Log user out
    public function logout(){
        session_unset();
        session_destroy();
    }

    // Redirect to login
    public function redirectToLogin(){
        header("Location: ../login.php");
        exit;
    
    }
}

?>