<?php
    require_once "../server/Database.php";
    $_POST = json_decode(file_get_contents("php://input"),true);
    $db = new Database();
    $sql = "update produtos set nome = :nome where idprod = :idprod";
    $exec = $db->getConn()->prepare($sql);
    $exec->bindParam(":nome", $_POST["nome"], PDO::PARAM_STR);
    $exec->bindParam(":idprod", $_POST["idprod"], PDO::PARAM_STR);
    $exec->execute();
    $sql = "update precos set preco = :preco where idprod = :idprod";
    $exec = $db->getConn()->prepare($sql);
    $exec->bindParam(":preco", $_POST["precos"], PDO::PARAM_STR);
    $exec->bindParam(":idprod", $_POST["idprod"], PDO::PARAM_STR);
    $exec->execute();
    $result = $exec->fetch(PDO::FETCH_ASSOC);
?>