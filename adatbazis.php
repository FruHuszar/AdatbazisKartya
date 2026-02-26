<?php
    class AB{
        //adattagok
        private $host = "localhost";
        private $fNev = "root";
        private $fJelszo = "";
        private $abNev = "magyarkartya";
        private $kapcsolat;
        //konstruktor
        public function __construct()
        {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            try {
                //kapcsolódás
                $this->kapcsolat = new mysqli(
                    $this->host,
                    $this->fNev,
                    $this->fJelszo,
                    $this->abNev,
                );
                $this->kapcsolat->set_charset("utf8");
            } catch (mysqli_sql_exception $e) {
                //hibadobás
                throw new Exception("
                Adatbázis kapcsolódási hiba" . $e ->getMessage());
            }
        }
        //tagfüggvények
    }
