<?php
//include altri file
require_once 'db_manager.php';
require_once 'sala.php'
require_once 'pezzo.php';
//creazione connesione, chiama il metodo statico della classe database
$pdo = Database::Connessione('localhost', 'organizzazione_concerti', '/config.txt');
class Concerto
{
    
    //attributi
    private int $id;
    private string $codice;
    private String $titolo;
    private string $descrizione;
    private string $dataConcerto;
    private Sala $sala;

    
    //metodi get set
    public function getId()
    {
        return $this->id;
    }
    
    public function getCodice()
    {
        return $this->codice;
    }

    public function setCodice($codice)
    {
        $this->codice = $codice;
    }

    public function getTitolo()
    {
        return $this->titolo;
    }
    public function setTitolo($titolo)
    {
        $this->titolo = $titolo;
    }
    public function getDescrizione()
    {
        return $this->descrizione;
    }
    public function setDescrizione($descrizione)
    {
        $this->descrizione = $descrizione;
    }
    public function getDataConcerto()
    {
        return $this->dataConcerto;
    }
    public function setDataConcerto($dataConcerto)
    {
        $this->dataConcerto = $dataConcerto;
    }

    public function GetPezzi()
    {
        $pdo = Database::Connessione('localhost', 'organizzazione_concerti', '/config.txt');
        $id=$this->getId();
        $sql="SELECT p.id ,p.codice,p.titolo  from organizzazione_concerti1.concerto_pezzi cp 
        inner join pezzi p on cp.id_pezzo=p.id 
        where cp.id_concerto =:id";
        $stmt=$pdo-> prepare($sql);
        $stmt-> bindParam(':id',$id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Pezzo");
    }
    public function getSala()
    {
        global $pdo;
        $sql = "SELECT * from sale where id_concerto = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $this->getId());
        $stmt->execute();
        //ritorna un oggetto
        return $stmt->fetchObject(__CLASS__);
    }

    //metodo delete
    public function Delete()
    {
        global $pdo;
        $id = $this->getId();
        //query
        $sql ="DELETE FROM concerti WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        //eseguzione query
        $stmt->execute();

    }
    //metodo create
    public static function Create($params)
    {
        global $pdo;
        
        //Inserimento sul database
        //query
        $sql = "INSERT INTO concerti (codice, titolo, descrizione, dataConcerto) VALUES (:codice, :titolo, :descrizione, :dataConcerto)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':codice', $params['codice']);
        $stmt->bindParam(':titolo', $params['titolo']);
        $stmt->bindParam(':descrizione', $params['descrizione']);
        $stmt->bindParam(':dataConcerto', $params['dataConcerto']);
        //eseguzione query
        $stmt->execute();
        
        $sql = "SELECT * from concerti order by id desc limit 1";
        $stmt = $pdo->query($sql);
        return $stmt->fetchObject(__CLASS__);
    }
    //metodo find
    public static function Find($id)
    {
        global $pdo;
        //query
        $sql = "SELECT * from concerti where id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        //ritorna un oggetto
        return $stmt->fetchObject(__CLASS__);
    }
    //metodo update
    public function Update($params)
    {
            // Verifica se i parametri da aggiornare sono presenti nell'array
            if (!empty($params['codice'])) {
                $this->setCodice($params['codice']);
            }
            if (!empty($params['titolo'])) {
                $this->setTitolo($params['titolo']);
            }
            if (!empty($params['descrizione'])) {
                $this->setDescrizione($params['descrizione']);
            }
            if (!empty($params['dataConcerto'])) {
                $this->setDataConcerto($params['dataConcerto']);
            }
            //richiama il metodo save per aggiorna database
            $this->Save();
    }
    //metodo save
    private function Save()
    {
        global $pdo;
        //query
        $sql = "UPDATE concerti SET codice = :codice, titolo = :titolo, descrizione = :descrizione, dataConcerto = :dataConcerto WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':codice', $this->codice);
        $stmt->bindParam(':titolo', $this->titolo);
        $stmt->bindParam(':descrizione', $this->descrizione);
        $stmt->bindParam(':dataConcerto', $this->dataConcerto);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }
    //metodo show
    public function Show()
    {
        // Stampa le informazioni sull'oggetto Concerto
        echo "ID: " . $this->getId() . "\n";
        echo "Codice: " . $this->getCodice() . "\n";
        echo "Titolo: " . $this->getTitolo() . "\n";
        echo "Descrizione: " . $this->getDescrizione() . "\n";
        echo "Data del concerto: " . $this->getDataConcerto() . "\n";
    }

    //metodo per visualizzazione di tutti record sul database
    public static function FindAll()
    {
        global $pdo;
        //Esegue il query
        $sql = "SELECT * FROM concerti";
        $stmt = $pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_CLASS, "concerto");
    }
}
?>