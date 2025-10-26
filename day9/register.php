<?php

include 'config.php';


$errors = [];
if($_SERVER['REQUEST_METHOD']=="POST"){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    //validating the input data
    if(empty($name)){
        $errors[] = "Name is required";
    }
    if(empty($email) ||!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors[] = "Email required and in proper format";
    }
    if(empty($password)){
        $errors[] = "Password is required!";
    }elseif(strlen($password)<6){
        $errors[] = "Password must be atleast 6 character long";
    }

    //If no error, inserting into the db
    if(empty($errors)){
        try{

            //checking if the email already exist or not
            $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $check ->execute([$email]);

            if($check->rowCount()>0){
                $errors[] = "Email already registered";
            }
            else{
                //hashing the password before insertion
                $hashedPassword = password_hash($password,PASSWORD_DEFAULT);

                $stmt = $conn->prepare("INSERT INTO users(name, email, password) values (? ,?,?)");
                $stmt->execute([$name, $email, $hashedPassword]);

                //success message
                echo "<script> alert('Registration successful') window.location.href = 'login.php' </script>";
            }
        }
        catch(PDOException $e){
            $errors[] = "ERROR:" .$e->getMessage();
        }
    }
}
?>

<!--form-->
<form method="post" action="">
        Name: <input type="text" name="name" value="<?= htmlspecialchars($name ?? '')?>" required><br><br>
        Email: <input type="email" name="email" value="<?=htmlspecialchars($email ?? '')?>" required><br><br>
        Password: <input type="password" name="password"  required><br><br>
        <button type="submit">Register</button>
</form>

<!--If more than one error occurs-->
<?php if(!empty($errors)): ?>
    <div style="color: red;">
        <ul>
            <?php foreach($errors as $error):?>
                <li><?=htmlspecialchars($error)?></li>
                <?php endforeach;?>
        </ul>
    </div>
<?php endif; ?>