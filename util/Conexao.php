<?php 
class Conexao {
    private static $conn;

    public static function getConn(){
        if(self::$conn ==null){
            $opcoes = array(
            //define o charset da con
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            //define o erro como exceção
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            //define o retorno das consultas
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            );
            $dadosCon = "mysql:host=localhost:3307;dbname=filmes";
            self::$conn = new PDO($dadosCon,"root","",$opcoes);
        }
        return self::$conn;
    }
}

?>