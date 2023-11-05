<?php
class Sala
{
    private int $id;
    private string $codice;
    private int $capienza;
    private int $idConcerto;

    public function getIdConcerto()
    {
        return $idConcerto;
    }
    public function setIdConcerto($num)
    {
        $idConcerto=$num;
    }
    public function getId()
    {
        return $id;
    }
    public function getCodice()
    {
        return $codice;
    }
    public function getCapienza()
    {
        return $capienza;
    }
    public function setCodice(string $num)
    {
        $codice=$num;
    }
    public function setCapienza(int $num)
    {
        $capienza=$num;
    }
    public function Show()
    {
        echo "ID: " . $this->getId() . "\n";
        echo "Codice: " . $this->getCodice() . "\n";
        echo "Capienza: " . $this->getCapienza() . "\n";
        echo "Id_concerto: " . $this->getIdConcerto() . "\n";
    }
}
?>