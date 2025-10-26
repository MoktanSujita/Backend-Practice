<?php
include 'config.php';

//session started
session_start();
$errors = [];


if($_SERVER["REQUEST_METHOD"] == "POST"){
    //parsing the form data
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    //validating the form
    if(empty($email) || empty($password)){
        $errors[] = "Email and passwords are required!";
    }else{
        //checking if the user is registered or not
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt ->execute([$email]);
        $user = $stmt -> fetch(PDO::FETCH_ASSOC);

        //Checking if the user exists
        if(!$user){
            echo"<script>alert('Email not found! Please register first.');
            window.location.href = 'register.php';
            </script>";
            exit;
        }

        //password verification
        if($user && password_verify($password, $user['password'])){
            $_SESSION['user'] = $user;
            header('Location: dashboard.php');
            exit;
        }else{
            $errors[] = "Invalid email or password";
        }
    }

}
?>

<h2>Login</h2>
<form method="post" action="">
    Email: <input type="email" name="email" value="<?= htmlspecialchars($email ?? '')?>"><br><br>
    Password: <input type="password" name="password"><br><br>
    <button type="submit">Login</button>
</form>

<!--displaying multiple errors (if any) in a form of list-->
<?php if(!empty($errors)): ?>
    <div style="color: red;">
        <ul>
            <?php foreach($errors as $error):?>
                <li><?= htmlspecialchars($error)?></li>
            <?php endforeach;?>
        </ul>
    </div>
<?php endif;?>