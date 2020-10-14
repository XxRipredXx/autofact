<?php

include "config.php";
include "utils.php";

$dbConn =  connect($db);

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    $sql = $dbConn->prepare("SELECT * FROM respuestas");
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    header("HTTP/1.1 200 OK");
    echo json_encode( $sql->fetchAll()  );
    exit();
}


// Crea una respuesta
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $input = $_POST;
    $sql = "INSERT INTO respuestas
    (usuario_id, resp_1, resp_2, resp_3)
    VALUES
    (:usuario_id, :resp_1, :resp_2, :resp_3)";
    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    $respId = $dbConn->lastInsertId();
    if($respId)
    {
      $input['id'] = $respId;
      header("HTTP/1.1 200 OK");
      echo json_encode($input);
      exit();
	 }
}


if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
	$id = $_GET['id'];
    $statement = $dbConn->prepare("DELETE FROM respuestas where id=:id");
    $statement->bindValue(':id', $id);
    $statement->execute();
	header("HTTP/1.1 200 OK");
	exit();
}


?>