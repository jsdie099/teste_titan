<?php
class Database
{
    private static $connection = null;
    private static function conectar()
    {

        try
        {
            if(self::$connection==null)
            {
                //Cria conexão com o banco de dados através da função PDO
                self::$connection = new PDO('mysql:host=localhost;dbname=test',"root","",
                array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'));
            }
        }
        catch (Exception $e)
        {
            //mostra um erro de conexão, caso ela não seja possível
            echo "Erro: {$e->getMessage()}";
            die;
        }
        return self::$connection;
    }
    public function getConn()
    {
        //retorna a conexão em uma função que pode ser chamada fora da classe
        return self::conectar();
    }
}