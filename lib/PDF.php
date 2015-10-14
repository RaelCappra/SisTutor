<?php

require_once 'fpdf17/fpdf.php';
class PDF extends FPDF{
    
    
    function setVendedor($vendedor) {
        $this->vendedor = $vendedor;
    }

      
    function Header(){
        $this->SetFont('Arial','B',15);
        $this->Cell(250);
        $this->Cell(30,10,$this->vendedor,0,0,'C');
        $this->Ln(20);

    }
    
    function Footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,$this->PageNo(),0,0,'C');
    }
    
    function BasicTable($header,$data){
        
        foreach ($header as $col) {
            $this->Cell(200, 20, $col, 1);
        }
        $this->Ln();
        
        foreach($data as $row){
            
            foreach ($row as $col) {
                $this->Cell(200, 18, $col, 1);  
            }
            
            $this->Ln();
        }
    }
    

}
