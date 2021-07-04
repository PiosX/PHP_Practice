<?php
    class Gracz
    {
        private $punkty;
        private $imie;
        private $wzrost;

        public function __construct($imie, $wzrost)
        {
            $this->imie = $imie;
            $this->wzrost = $wzrost;
            $this->punkty = new Punktacja;
        }

        public function __destruct()
        {
            echo "Imie: ".$this->imie.", Wzrost: ".$this->wzrost;
        }
    }

    class Punktacja
    {
        private $iloscPunktow;

        public function __construct($ilosc=0)
        {
            $this->iloscPunktow = $ilosc;
        }

        public function __destruct()
        {
            echo "Koncowa ilosc punktow: ".$this->iloscPunktow;
        }

        public function aktualizuj($ilosc)
        {
            $this->iloscPunktow += $ilosc;
        }
    }
?>