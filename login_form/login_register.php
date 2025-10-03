<?php 
session_start(); // starts the php session
require_once 'config.php';//
// checks if the variable has been set or not
if(isset ($_POST[''])){
    $name = $_POST['']; //defining variables
    $email =$_POST[''];
    $password = password_hash($_POST[''], PASSWORD_DEFAULT); // shows password is securely stored in database
    $role = $_POST[''];

    $checkEmail = $conn->query("SELECT email FROM users WHERE email ='$email'"); //checks if the email is already used in the user table
    if ($checkEmail->num_rows > 0){
        $_SESSION['register_error'] = 'Email is already registered!'; // dispalys the error message
        $_SESSION['active_form'] = 'register';

    }else{
        $conn->query("INSET INTO user(name, email, password,role) Values ('$name','$email', '$password', '$role')");

    }
    header("location:index.php"); // displays the login form again
    exit();
    if (isset($_POST[''])){
        $email = $_POST[''];
        $password = $_POST[''];

        $Result = $conn->query("SELECT* FROM user WHERE email ='$email'");
        if ($Result->num_rows > 0) {
            $user =$result->fetch_assoc();
            if (password_verify($password, $user['password'])){
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];

                if ($user['role']==='admin'){
                    header("Location: admin_page.php");

                }else{
                    header("Location: user_page.php");
                }
                exit();
            }
        }
    }
    $_SESSION['login_error'] ='Incorrect email';
    $_SESSION['active_form'] = 'login';
    header("Location:index.php");
    exit();
}
?>