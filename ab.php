<?php
require_once "kartya.php";
class AB{
    //adattagok
    private $host="localhost";
    private $fNev="root";
    private $jelszo="";
    private $abNev="magyarkartya";
    private $kapcsolat;

    //konstruktor
    public function __construct()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $this->kapcsolat = new mysqli(
                $this->host,
                $this->fNev,
                $this->jelszo,
                $this->abNev
            );
            $this->kapcsolat->set_charset("utf8");
        } catch (mysqli_sql_exception $e) {
            throw new Exception(
                "Adatbázis kapcsolódási hiba történt: ".
                $e->getMessage());
        }
    }

    public function kapcsolatLezar(){
        $this->kapcsolat->close();
    }

    //tagfüggvények
    public function oszlopBeolvas($oszlop, $tabla){
        $sql = "SELECT $oszlop FROM $tabla";
        $matrix = $this->kapcsolat->query($sql);
        return $matrix;
    }

    public function oszlopBeolvasTobb($oszlop1, $oszlop2, $tabla){
        $sql = "SELECT $oszlop1, $oszlop2 FROM $tabla";
        $matrix = $this->kapcsolat->query($sql);
        return $matrix;
    }

    public function kartyakBeolvasasa(){
        $sql = "SELECT sz.kep, f.nev
                FROM `kartya` as k
                INNER JOIN szin as sz ON k.szinAzon = sz.szinAzon
                INNER JOIN forma as f ON f.formaAzon = k.formaAzon";
        $matrix = $this->kapcsolat->query($sql);
        return $matrix;
    }    

    public function kartyaObjektumok($matrix){
        $kartyak = array();
        while ($sor = $matrix->fetch_assoc()){
            $kartya = new Kartya();
            $kartya->setSzin($sor["kep"]);
            $kartya->setForma($sor["nev"]);
            //echo $kartya;
            array_push($kartyak, $kartya);
        }
        shuffle($kartyak);
        return $kartyak;
    }

    public function megjelenit($matrix){
        while ($sor = $matrix->fetch_row()) {
            //$mezo = "kep";
            echo "<img src='forras/$sor[0]' alt='$sor[0]'>";
        }
    }
    public function megjelenitTobb($matrix){
        echo "<table>";
        while ($sor = $matrix->fetch_row()) {
            /* $mezo1 = "szinAzon";
            $mezo2 = "kep"; */
            echo "<tr>";
            echo "<td>$sor[0]</td>";
            echo "<td><img src='forras/$sor[1]' alt='$sor[1]'></td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    public function meret($tabla){
        $sql = "SELECT * FROM $tabla";
        return $this->kapcsolat->query($sql)->num_rows;
    }

    public function feltoltes(){
        $formaMeret = $this->meret("forma");
        $szinMeret = $this->meret("szin");
        for ($i=1; $i <= $formaMeret; $i++) { 
            for ($j=1; $j <= $szinMeret; $j++) { 
                try {
                    $stmt = $this->kapcsolat->prepare("INSERT INTO `kartya`(`formaAzon`, `szinAzon`) VALUES (?,?)");
                    $formaAzon = $i;
                    $szinAzon = $j;
                    $stmt->bind_param("ss", $formaAzon, $szinAzon);
                    $stmt->execute();
                    $stmt->close();
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }
    }

    public function tombbeAlakit($matrix){
        return $matrix->fetch_all(MYSQLI_ASSOC);
    }

}
?>