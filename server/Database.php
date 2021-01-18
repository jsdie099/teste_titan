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
                //Cria conex�o com o banco de dados atrav�s da fun��o PDO
                self::$connection = new PDO('mysql:host=localhost;dbname=test',"root","",
                array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'));
            }
        }
        catch (Exception $e)
        {
            //mostra um erro de conex�o, caso ela n�o seja poss�vel
            echo "Erro: {$e->getMessage()}";
            die;
        }
        return self::$connection;
    }
    public function getConn()
    {
        //retorna a conex�o em uma fun��o que pode ser chamada fora da classe
        return self::conectar();
    }
}