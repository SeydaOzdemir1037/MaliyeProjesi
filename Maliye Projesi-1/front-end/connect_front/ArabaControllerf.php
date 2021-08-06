<?php


class ArabaControllerf extends DBControllerf
{
    function arabaGetir()
    {
        $sth = $this->conn->prepare("SELECT araba.id,kisi.kisi_ad,kisi.kisi_soyad,araba.marka,araba.yil,araba.km
FROM araba
INNER JOIN kisi ON kisi.id=araba.kisi_id
ORDER BY araba.id ASC;");
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }
    function kisiAraba($id)
    {
        $sth = $this->conn->prepare("SELECT araba.id,araba.marka,araba.yil,araba.km
FROM araba
INNER JOIN kisi ON kisi.id=araba.kisi_id
WHERE kisi.id= ? ;");
        $sth->execute([$id]);
        $result = $sth->fetchAll();
        return $result;
    }

    function arabaEkle($marka,$yil,$km,$kisi_id){
        $sth = $this->conn->prepare("INSERT INTO araba
		(`marka`,`yil`,`km`,`kisi_id`)
		VALUES (?,?,?,?)");
        $flag = $sth->execute([$marka,$yil,$km,$kisi_id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function arabaGuncelle($marka, $yil, $km, $id)
    {
        $sth = $this->conn->prepare(" UPDATE araba SET marka = ?,yil = ?, km = ? WHERE id = ?");
        $flag =$sth->execute([$marka, $yil, $km, $id]);
        if($flag){
            return true;
        }
        else{
            return false;
        }
    }


    function arabaSil($id){
        $sth = $this->conn->prepare("DELETE FROM araba WHERE araba.id = ?");
        $flag = $sth->execute([$id]);

        if($flag){
            return true;
        }
        else{
            return false;
        }
    }

}