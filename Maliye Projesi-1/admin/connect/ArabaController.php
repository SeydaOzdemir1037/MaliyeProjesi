<?php


class ArabaController extends DBController
{
    function arabaGetir()
    {
        $sth = $this->conn->prepare("SELECT araba.id,kisi.kisi_ad,kisi.kisi_soyad,araba.marka,araba.yil,araba.km
FROM araba
INNER JOIN kisi ON kisi.id=araba.kisi_id
ORDER BY araba.id ASC;");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    function arabalar()
    {
        $sth = $this->conn->prepare("SELECT * FROM araba order by araba.id ASC;");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    function arabaEkle($kisi_id, $marka, $yil, $km)
    {

        $sth = $this->conn->prepare("INSERT INTO araba
		(`kisi_id`,`marka`,`yil`,`km`)
		VALUES (?,?,?,?)");
        $flag = $sth->execute([$kisi_id, $marka, $yil, $km]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }


    function arabaSil($id)
    {
        $sth = $this->conn->prepare("DELETE FROM araba WHERE id=?");
        $flag = $sth->execute([$id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function arabaBul($id)
    {
        $sth = $this->conn->prepare("SELECT * FROM araba WHERE id = ?");
        $sth ->execute([$id]);
        $result = $sth->fetch();
        return $result;

    }

    function arabaGuncelle($kisi_id,$marka,$yil,$km,$id){
        $sth = $this->conn->prepare("UPDATE araba SET kisi_id = ?, marka = ?,yil = ?,km = ? WHERE id = ?");
        $flag= $sth ->execute([$kisi_id,$marka,$yil,$km,$id]);
        if($flag){
            return true;
        }
        else{
            return false;
        }

    }
}