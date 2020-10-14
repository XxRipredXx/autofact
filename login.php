<!DOCTYPE html>
<html>
    <?php
    
    include('config.php');
    session_start();
    
    if (isset($_POST['login'])) {
    
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $query = $connection->prepare("SELECT * FROM users WHERE EMAIL=:email");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();
        
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        if (!$result) {
            echo '<p class="error">Combinacion erronea</p>';
        } else {

            $_SESSION['user_id'] = $result['id'];

            if($result['tipo'] == 'admin'){
                header('Location: resumen_admin.php');
            }else if($result['tipo'] == 'user'){
                header("Location: http://localhost/autofact/formulario.php");
                echo '<p class="success">Congratulations, you are logged in!</p>';
            }
        }
    }
    
    
    ?>

    
    <head>
        <title>Autofact</title>
        
    </head>
    <body>

    <form method="post" action="" name="signin-form">
        <div class="form-element">
            <label>Username</label>
            <input type="text" name="email" required />
        </div>
        <div class="form-element">
            <label>Password</label>
            <input type="password" name="password" required />
        </div>
        <button type="submit" name="login" value="login">Log In</button>
    </form>

    </body>
</html>