<?php


class ArsaController extends DBController
{

    function arsalariGetir()
    {
        $sth = $this->conn->prepare("SELECT arsa.id,kisi.kisi_ad,kisi.kisi_soyad,arsa.parsel,il.il,ilce.ilce
FROM arsa
INNER JOIN il ON il.id=arsa.il_id
INNER JOIN  ilce ON arsa.ilce_id=ilce.id
INNER JOIN  kisi ON kisi.id=arsa.kisi_id
order by arsa.id ASC;");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }


    function arsaEkle($parsel,$kisi_id,$il_id,$ilce_id){

        $sth = $this->conn->prepare("INSERT INTO arsa
		(`parsel`,`kisi_id`,`il_id`,`ilce_id`)
		VALUES (?,?,?,?)");
        $flag = $sth->execute([$parsel,$kisi_id,$il_id,$ilce_id]);
        if($flag){
            return true;
        }
        else{
            return false;
        }
    }

    function arsaSil($id){
        $sth = $this->conn->prepare("DELETE FROM arsa WHERE id = ?");
        $flag = $sth->execute([$id]);

        if($flag){
            return true;
        }
        else{
            return false;
        }
    }

    function arsaBul($id){
        $sth = $this->conn->prepare("SELECT * FROM arsa WHERE id = ?");
        $sth ->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }

    function arsaGuncelle($kisi_id,$il_id,$ilce_id,$parsel,$adres,$id){
        $sth = $this->conn->prepare("UPDATE arsa SET kisi_id = ?, il_id = ?, ilce_id = ?,parsel = ?, adres = ? WHERE id = ?");
        $flag =$sth->execute([$kisi_id,$il_id,$ilce_id,$parsel,$adres,$id]);

        if($flag){
            return true;
        }
        else{
            return false;
        }

    }

}