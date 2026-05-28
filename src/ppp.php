<?php 
class Safe {
  private $secretCode = "hello World для лохов Пиши привет мир";
  
    public function setSecretCode($code) {
        $this->secretCode=$code; 
    }
    public function getSecretCode() {
        return $this->secretCode;
    }
}
$safe = new Safe() ;
/*echo $safe->secretCode;*/
echo $safe->getSecretCode();
echo $safe->setSecretCode("coder");
echo $safe->getSecretCode();
?>