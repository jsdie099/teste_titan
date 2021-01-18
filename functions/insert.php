<?php
    require_once "../server/Database.php";
    //recebe os valores de requisições assíncronas
    $_POST = json_decode(file_get_contents("php://input"),true);
    
    //declara o objeto do banco
    $db = new Database();
    //código de inserção do banco
    $sql = "insert into produtos(nome, cor) values(:nome, :cor)";
    //prepara os valores para serem inseridos, verificando se eles estão no formato correto
    $exec = $db->getConn()->prepare($sql);
    $exec->bindParam(":nome", $_POST["nome"], PDO::PARAM_STR);
    $exec->bindParam(":cor", $_POST["cores"], PDO::PARAM_STR);
    $exec->execute();
    //pega o último id inserido em produtos para usar nos precos
    foreach($db->getConn()->query("select max(idprod) idprod from Produtos") as $value){
        $sql = "insert into Precos(idprod, preco) values(:idprod, :preco)";
        $exec = $db->getConn()->prepare($sql);
        $exec->bindParam(":idprod", $value["idprod"], PDO::PARAM_INT);
        $exec->bindParam(":preco", $_POST["precos"]);
        $exec->execute();    
    }
?>