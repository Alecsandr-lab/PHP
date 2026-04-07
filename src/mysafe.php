<?php 
class  SmartSafe {

    private $secretdata=("10000000");
    private $pincode=2544;
    private $isLocked=false;
    protected $accessAttempts=0;

    private function verfyPin($inputPin){
        if ($this->accesAttpts>3) {
            return "доступ заблокирован";        
         }
        if ($this->pincode==$inputPin) {
            return $this->secretdata;
        } else {
                 $this->accessAttempts+=1;
                 return "досткп запрещен";
        }
    }
}


?>