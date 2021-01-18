<?php
    require_once "../server/Database.php";

    $db = new Database();
    
    $sql = "select * from Produtos 
            inner join Precos on Precos.idprod = Produtos.idprod";
    $exec = $db->getConn()->prepare($sql);
    $exec->execute();
    $result = $exec->fetchAll(PDO::FETCH_ASSOC);
    for($i=0; $i<count($result); $i++){
        if($result[$i]["cor"] == "AZUL" || $result[$i]["cor"] == "VERMELHO"){
            $result[$i]["preco"] = $result[$i]["preco"] - (($result[$i]["preco"]*20)/100);
        }
        if($result[$i]["cor"] == "AMARELO"){
            $result[$i]["preco"] = $result[$i]["preco"] - (($result[$i]["preco"]*10)/100);
        }
        if($result[$i]["cor"] == "VERMELHO" && $result[$i]["preco"] > 50){
            $result[$i]["preco"] = $result[$i]["preco"] - (($result[$i]["preco"]*5)/100);
        }
        $result[$i]["preco"] = number_format($result[$i]["preco"], 2, ',', '.');
        
    }
    echo json_encode($result);