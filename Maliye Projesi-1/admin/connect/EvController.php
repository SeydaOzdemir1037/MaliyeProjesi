<?php


class EvController extends DBController
{
    function evleriGetir()
    {
        $sth = $this->conn->prepare("SELECT ev.id,kisi.kisi_ad,kisi.kisi_soyad,il.il,ilce.ilce,ev.adres
FROM ev
INNER JOIN il ON il.id=ev.il_id
INNER JOIN ilce ON ev.ilce_id=ilce.id
INNER JOIN kisi ON kisi.id=ev.kisi_id
ORDER BY ev.id ASC;");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    function evEkle($kisi_id,$il_id,$ilce_id,$adres){

        $sth = $this->conn->prepare("INSERT INTO ev
		(`kisi_id`,`il_id`,`ilce_id`,`adres`)
		VALUES (?,?,?,?)");
        $flag = $sth->execute([$kisi_id,$il_id,$ilce_id,$adres]);
        if($flag){
            return true;
        }
        else{
            return false;
        }
    }

    function evSil($id){
        $sth = $this->conn->prepare("DELETE FROM ev WHERE id =?");
        $flag = $sth->execute([$id]);
        if($flag){
            return true;
        }
        else{
            return false;
        }
    }

    function evBul($id){
        $sth = $this->conn->prepare("SELECT * FROM ev WHERE id= ?");
        $sth->execute([$id]);
        $result= $sth->fetch();
        return $result;
    }

    function evGuncelle($kisi_id,$il_id,$ilce_id,$adres,$id){
        $sth = $this->conn->prepare("UPDATE ev SET kisi_id = ?, il_id = ?, ilce_id = ?, adres = ? WHERE id = ? ");
        $flag =$sth->execute([$kisi_id,$il_id,$ilce_id,$adres,$id]);
        if($flag){
            return true;
        }
        else{
            return false;
        }
    }
}