<?php
class Pezzo
{
    private int $id;
    private int $codice;
    private string $titolo;

    public function GetId()
    {
        return $id;
    }
    public function GetCodice()
    {
        return $codice;
    }
    public function GetTitolo()
    {
        return $titolo;
    }
    public function SetCodice(int $num)
    {
        $codice=$num;
    }
    public function SetTitolo(string $str)
    {
        $titolo=$str;
    }
    public function Show()
    {
        echo "ID: " . $this->getId() . "\n";
        echo "Codice: " . $this->getCodice() . "\n";
        echo "Titolo: " . $this->getTitolo() . "\n";
    }
}
?>