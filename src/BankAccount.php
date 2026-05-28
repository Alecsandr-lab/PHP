<?php 
class BankAccount {

 protected $balance=0;
 private $login="alibibek";
 public function deposit($amount) {
    if ($amount>0) {
      $this->balance=$this->balance+$amount;
    }
 }

 public function getBalance($login){
    if ($this->login == $login){
         return $this->balance;
    } else {
        return "логин не верный";
    }
 }

}

$BankAccount = new BankAccount();
 echo $BankAccount->getBalance("alibibekt");
 $BankAccount->deposit(-1000);
 echo $BankAccount->getBalance("alibibek");
 $BankAccount->deposit(2000-1000);
 echo $BankAccount->getBalance("alibibek");
?>