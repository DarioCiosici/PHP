<?php
//classe database per gestire connesione al database
class Database
{
    public static function Connessione($host, $dbname, $config_file)
    {
        $lines = file(__DIR__ . $config_file);
        $username = trim($lines[0]);
        $password =  trim($lines[1]);
        $dsn = "mysql:host={$host};dbname={$dbname}";
        $pdo = new PDO($dsn, $username, $password);
        return $pdo;
    }
}
?>