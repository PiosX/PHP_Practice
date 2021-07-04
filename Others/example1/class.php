<?php
    class Przycisk
    {
        private $nazwa;
        private $rozmiar = array('szerokosc'=>0, 'wysokosc'=>0);

        public function stworz($nazwa, $szerokosc, $wysokosc)
        {
            $this->nazwa = $nazwa;
            $this->rozmiar['szerokosc'] = $szerokosc;
            $this->rozmiar['wysokosc'] = $wysokosc;
        }
    }

    class Panel 
    {
        private $przyciski = array();
        private $ilosc = 0;

        public function dodaj($nazwa,$szerokosc,$wysokosc)
        {
            if(!(is_int($szerokosc)&&is_int($wysokosc)))
            {
                echo "Podales zle dane";
                return;
            }
            else
            {
                $this->przyciski[$this->ilosc] = new Przycisk;

                $this->przyciski[$this->ilosc++]->stworz($nazwa, $szerokosc, $wysokosc); 
            }
        }
        public function usun($ktory)
        {
            if($ktory > $this->ilosc)
            {
                echo "nie ma takiego przycisku";
                return;
            }
            else
            {
                unset($this->przyciski[--$ktory]);
                --$this->ilosc;
            }
        }

        function zwrocIlosc()
        {
            return $this->ilosc;
        }
    }
?>