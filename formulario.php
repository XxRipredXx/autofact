<!DOCTYPE html>
<?php

session_start();
 
if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
    exit;
} else {
    
}
?>
<html>
    <head>
        <title>Formulario</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    </head>
    <body>

    <h1>Formulario</h1>

    <form method="post" action="" name="signin-form" class="form-control">
    <br>
        <div class="form-element"><br>
            <label>Qué Te gustaria que le agregaramos al informe</label>
            <textarea name="resp_1" rows="5" cols="2" class="form-control"> </textarea>
        </div>
        <div class="form-element"><br>
            <label>¿La informacion es correcta?</label>
            <select name="resp_2" class="form-control">
                <option value="si" selected>Si</option> 
                <option value="no">No</option>
                <option value="mas o menos">Mas o menos</option>
            </select>
        </div>
        <br>
        <label>¿ del 1 al 5 es rapido el sitio?</label>
        <div class="form-element">
            <input type="radio" id="1" name="opcion" value="1">
            <label for="1">1</label><br>
            <input type="radio" id="2" name="opcion" value="2">
            <label for="2">2</label><br>
            <input type="radio" id="3" name="opcion" value="3">
            <label for="3">3</label><br>
            <input type="radio" id="4" name="opcion" value="4">
            <label for="4">4</label><br>
            <input type="radio" id="5" name="opcion" value="5">
            <label for="5">5</label>
        </div>

        <button type="submit" name="formulario" value="formulario">Enviar</button>

    </form>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
    </body>


    <?php
        include('config.php');

    if (isset($_POST['formulario'])) {

        $resp_1 = $_POST['resp_1'];
        $resp_2 = $_POST['resp_2'];
        $resp_3 = $_POST['opcion'];

        $usuario_id= $_SESSION['user_id'];

        $query = $connection->prepare("INSERT INTO respuestas(usuario_id,resp_1,resp_2,resp_3) VALUES (:usuario_id, :resp_1, :resp_2, :resp_3)");
        $query->bindParam("usuario_id", $usuario_id, PDO::PARAM_STR);
        $query->bindParam("resp_1", $resp_1, PDO::PARAM_STR);
        $query->bindParam("resp_2", $resp_2, PDO::PARAM_STR);
        $query->bindParam("resp_3", $resp_3, PDO::PARAM_STR);
        $result = $query->execute();
        
        if ($result) {
            echo '<p class="success">Formulario Enviado</p>';
        } else {
            echo '<p class="error">Error al enviar formulario</p>';
        }
    }

    ?>
</html>