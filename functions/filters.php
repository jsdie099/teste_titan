<?php
    require_once "../server/Database.php";
    $db = new Database();
    
    $sql = "select * from Produtos 
            inner join Precos on Precos.idprod = Produtos.idprod";
    if(isset($_GET["nome"]) && !empty($_GET["nome"])){
        $sql .= " where Produtos.nome = :nome";
        $exec = $db->getConn()->prepare($sql);
        $exec->bindParam(":nome", $_GET["nome"], PDO::PARAM_STR);
    }else if(isset($_GET["cor"]) && !empty($_GET["cor"])){        
        $sql .= " where Produtos.cor = :cor";
        $exec = $db->getConn()->prepare($sql);
        $exec->bindParam(":cor", $_GET["cores"], PDO::PARAM_STR);
    }else if(isset($_GET["preco"]) && !empty($_GET["preco"])){            
        $sql .= " where Precos.preco > :preco or
                 Precos.preco < :preco or
                 Precos.preco = :preco";
        $exec->bindParam(":preco", $_GET["precos"]);
        $exec = $db->getConn()->prepare($sql);
    }else if(isset($_GET["nome"]) && !empty($_GET["nome"]) && isset($_GET["cor"]) && !empty($_GET["cor"]) && isset($_GET["preco"]) && !empty($_GET["preco"])){                
        $sql .= " where Produtos.nome = :nome and
                  Produtos.cor = :cor and
                  Precos.preco > :preco or
                  Precos.preco < :preco or
                  Precos.preco = :preco";
        $exec = $db->getConn()->prepare($sql);
        $exec->bindParam(":nome", $_GET["nome"], PDO::PARAM_STR);
        $exec->bindParam(":cor", $_GET["cores"], PDO::PARAM_STR);
        $exec->bindParam(":preco", $_GET["precos"]);
    }
    
    $exec->execute();
    $result = $exec->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
    