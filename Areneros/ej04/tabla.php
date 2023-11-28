<?php

class tabla{
    private $matriz = array();
    private $numFilas;
    private $numComulnas;
    private $estilo;

    public function __construct($rows, $cols, $style) {
        $this->numFilas = $rows;
        $this->numComulnas = $cols;
        $this->estilo = $style;
    }

    public function cargar($row, $col, $val){
        $this->matriz[$row][$col] = $val;
    }

    private function inicio_Tabla(){
        echo '<table style = "'.$this->estilo.'">';
    }

    private function inicio_fila(){
        echo '<tr>';
    }

    private function mostrar_dato($row, $col){
        echo '<td style = "'.$this->estilo.'">'.$this->matriz[$row][$col].'</td>';
    }

    private function fin_fila(){
        echo '</tr>';
    }

    private function fin_tabla(){
        echo '</table>';
    }

    public function graficar(){
        $this->inicio_Tabla();
        for ($i=0; $i < $this->numFilas; $i++) { 
            $this->inicio_fila();
            for ($j=0; $j < $this->numComulnas; $j++) { 
                $this->mostrar_dato($i,$j);
            }
            $this->fin_fila();
        }
        $this->fin_tabla();
    }
}
?>