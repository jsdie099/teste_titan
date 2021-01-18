<?php
    require_once "../server/Database.php";
    //recebe os valores de requisi��es ass�ncronas
    $_POST = json_decode(file_get_contents("php://input"),true);
    
    //declara o objeto do banco
    $db = new Database();
    //c�digo de inser��o do banco
    $sql = "insert into produtos(nome, cor) values(:nome, :cor)";
    //prepara os valores para serem inseridos, verificando se eles est�o no formato correto
    $exec = $db->getConn()->prepare($sql);
    $exec->bindParam(":nome", $_POST["nome"], PDO::PARAM_STR);
    $exec->bindParam(":cor", $_POST["cores"], PDO::PARAM_STR);
    $exec->execute();
    //pega o �ltimo id inserido em produtos para usar nos precos
    foreach($db->getConn()->query("select max(idprod) idprod from Produtos") as $value){
        $sql = "insert into Precos(idprod, preco) values(:idprod, :preco)";
        $exec = $db->getConn()->prepare($sql);
        $exec->bindParam(":idprod", $value["idprod"], PDO::PARAM_INT);
        $exec->bindParam(":preco", $_POST["precos"]);
        $exec->execute();    
    }
?>