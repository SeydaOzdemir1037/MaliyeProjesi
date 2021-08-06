<?php


class IlControllerf extends DBControllerf
{
 function illeriGetir()
 {
     $sth = $this->conn->prepare("SELECT * FROM il order by id ASC;");
     $sth->execute();
     $result = $sth->fetchAll();
     return $result;
 }

 function ilBilgileri($id){
     $sth = $this->conn->prepare("SELECT * FROM il WHERE id=?;");
     $sth->execute([$id]);
     $result = $sth->fetch();
     return $result;
 }


}