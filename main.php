<?php
//include altri file
require_once 'concerto.php';
require_once 'sala.php'
function inserimentoDati()
{
    echo("Inserire il codice del concerto:\n");
    $codice = trim(readline());
    echo("Inserire il titolo del concerto:\n");
    $titolo = trim(readline());
    echo("Inserire la descrizione del concerto:\n");
    $descrizione = trim(readline());           
    echo("Inserire la data del concerto:\n");
    $dataConcerto = trim(readline()); 
    $params = array("titolo" => $titolo, "codice" => $codice, "descrizione" => $descrizione, "dataConcerto" => $dataConcerto);
    return $params;
}
do
{
    echo "premere 1 per creare un record:\n";
    echo "premere 2 per mostrare un record\n";
    echo "premere 3 per modificare un record\n";
    echo "premere 4 per eliminare un record\n";
    echo "premere 5 per mostrare tutti i records presenti nella tabella\n";
    echo "premere 6 per mostrare la sala di un concerto";
    echo "premere 7 per mostrare i pezzi di un concerto\n";
    echo "premere 0 per terminare il programma\n";
    $scelta = readline();//trim rimuove gli spazi dall'input dell'utente
    switch ($scelta) 
    {
        case '0':
        {
            echo("Termina programma");
            break;
        }
        case '1':
            $params = inserimentoDati();
            //crazione oggetto concerto
            $concerto = Concerto::Create($params);
            break;
        case '2':
            echo("Inserire il id del concerto da mostrare:\n");
            $id = readline();
            //Cerca nel database
            $datiConcerto = Concerto::Find($id);
            if($datiConcerto)
            {
                $datiConcerto->Show();
            }
            else
            {
                echo("Non esiste un record con id: " . $id . "\n");
            }
            break;
        case '3':
            echo("Inserisca l'id del record da eliminare:\n");
            $id = readline();
            $concerto = Concerto::Find($id);
            if($concerto)
            {
                $params = inserimentoDati();
                $concerto->Update($params);
            }
            else
            {
                echo("Non esiste un record con id" . $id . "\n");
            }
            break;
            
        case '4':
            echo("Inserisca l'id del record da eliminare:\n");
            $id = readline();
            $concerto = Concerto::Find($id);
            if($concerto)
            {
                $concerto->delete($id);
            }
            else
            {
                echo("Non esiste un record con id" . $id . "\n");
            }
            break;
        case '5':
            $concerti = Concerto::FindAll();
            foreach ($concerti as $concerto) {
                $concerto->show();
            }
            break;

        case '6':
            echo("Inserire il id del concerto di cui mostrare la sala:\n");
            $id = readline();
            //Cerca nel database
            $datiConcerto = Concerto::Find($id);
            if($datiConcerto)
            {
                $sala=$datiConcerto.getSala();
                $sala->Show();
            }
            else
            {
                echo("Non esiste un record con id: " . $id . "\n");
            }
            case '7':
                echo "Scegli l'id del concerto";
                $id = readline();
                $concerto = Concerto::Find($id);
                if($concerto)
                {
                    $array=$concerto->pezzi();
                    var_dump($array);
                }
                else
                {
                    echo("Non esiste un record con id" . $id . "\n");
                }
        default:
            echo "Scelta non valida. Si prega di scegliere un'opzione valida.\n";
    }   
} while($scelta != '0');
?>