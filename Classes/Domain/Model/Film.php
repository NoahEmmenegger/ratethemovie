<?php

namespace NoahEmmenegger\RateTheMovie\Controller;

class Film {
    // Properties
    private $Id = '';
    private $Titel ='';
    private $Beschreibung = '';
    private $Bild = '';
    private $Produzent ='';

    // Methods
    function set_titel($titel) {
        $this->Titel = $titel;
    }
    function get_titel() {
        return $this->Titel;
    }
    function set_beschreibung($beschreibung) {
        $this->Beschreibung = $beschreibung;
    }
    function get_beschreibung()
    {
        return $this->Beschreibung;
    }
    function set_bild($bild)
    {
        $this->Bild = $bild;
    }
    function get_bild()
    {
        return $this->Bild;
    }
    function set_produzent($produzent)
    {
        $this->Produzent = $produzent;
    }
    function get_produzent()
    {
        return $this->Produzent;
    }
}