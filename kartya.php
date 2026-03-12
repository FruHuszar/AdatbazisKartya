<?php
class Kartya{
    //adattagok
    private $szin;
    private $forma;
    //konstruktorok hiánya 
    //tagfüggvények
    function getSzin(){
        return $this->szin;
    }
    function getForma(){
        return $this->forma;
    } 
    function setSzin($szin){
        $this->szin = $szin;
    }
    function setForma($forma){
        $this->forma = $forma;
    }     
    function __toString()
    {
        return "<br>Kártya színe: ".$this->szin."<br>Kártya formája: ".$this->forma;
    }
}
?>