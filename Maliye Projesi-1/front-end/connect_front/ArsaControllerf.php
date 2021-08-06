<?php


class ArsaControllerf extends DBControllerf
{

    function arsalariGetir()
    {
        $sth = $this->conn->prepare("SELECT arsa.id,kisi.kisi_ad,kisi.kisi_soyad,arsa.parsel,il.il,ilce.ilce,arsa.adres
FROM arsa
INNER JOIN il ON il.id=arsa.il_id
INNER JOIN  ilce ON arsa.ilce_id=ilce.id
INNER JOIN  kisi ON kisi.id=arsa.kisi_id
order by arsa.id ASC");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    function kisiArsa($id)
    {
        $sth = $this->conn->prepare("SELECT arsa.id,adres,parsel,il.il,ilce.ilce FROM arsa
INNER JOIN il ON il.id=arsa.il_id INNER JOIN ilce ON ilce.id=arsa.ilce_id INNER JOIN kisi ON kisi.id=arsa.kisi_id
WHERE kisi.id= ?");
        $sth->execute([$id]);
        $result = $sth->fetchAll();
        return $result;
    }

    function arsaGetir($id)
    {
        $sth = $this->conn->prepare("SELECT arsa.id,il.id as il_id,il.il,ilce.ilce,ilce.id as ilce_id,arsa.adres,arsa.parsel
FROM arsa
INNER JOIN il ON il.id=arsa.il_id
INNER JOIN ilce ON arsa.ilce_id=ilce.id
INNER JOIN kisi ON kisi.id=arsa.kisi_id
WHERE arsa.id = ?");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }


    function arsaGuncelle($adres,$il_id,$ilce_id,$parsel,$id){
        $sth = $this->conn->prepare("UPDATE arsa SET  adres = ?,il_id = ?, ilce_id = ?,parsel = ? WHERE id = ?");
        $flag =$sth->execute([$adres,$il_id,$ilce_id,$parsel,$id]);

        if($flag){
            return true;
        }
        else{
            return false;
        }

    }

    function arsaEkle($il_id,$ilce_id,$adres,$parsel,$kisi_id)
    {
        $sth = $this->conn->prepare("INSERT INTO arsa
		(`il_id`,`ilce_id`,`adres`,`parsel`,`kisi_id`)
		VALUES (?,?,?,?,?)");
        $flag = $sth->execute([$il_id, $ilce_id, $adres,$parsel,$kisi_id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function arsaSil($id){
        $sth = $this->conn->prepare("DELETE FROM arsa WHERE arsa.id = ?");
        $flag = $sth->execute([$id]);

        if($flag){
            return true;
        }
        else{
            return false;
        }
    }
}