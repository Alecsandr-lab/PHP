<?php 
class Shet{

public $dva;
public $tri;

public function __construct($dva,$tri){
$this-> dva=$dva;
$this->tri=$tri;
}

public function info() {
    return $this->dva+$this->tri;
}


}
$number=new Shet(2,3);
echo $number->info();
?>