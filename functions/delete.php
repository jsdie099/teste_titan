<?php
    require_once "../server/Database.php";
    $_POST = json_decode(file_get_contents("php://input"),true);
    $db = new Database();
    $sql = "delete from produtos where idprod = :idprod";
    $exec = $db->getConn()->prepare($sql);
    $exec->bindParam(":idprod", $_GET["idprod"], PDO::PARAM_STR);
    $exec->execute();
    $sql = "delete from precos where idprod = :idprod";
    $exec = $db->getConn()->prepare($sql);
    $exec->bindParam(":idprod", $_GET["idprod"], PDO::PARAM_STR);
    $exec->execute();
    $result = $exec->fetch(PDO::FETCH_ASSOC);
?>