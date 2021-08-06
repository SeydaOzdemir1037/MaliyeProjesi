<?php


class EvControllerf extends DBControllerf
{
    function evleriGetir()
    {
        $sth = $this->conn->prepare("SELECT ev.id,kisi.kisi_ad,kisi.kisi_soyad,il.il,ilce.ilce,ev.adres,ev.m2,ev.durum,ev.odasayisi
FROM ev
INNER JOIN il ON il.id=ev.il_id
INNER JOIN ilce ON ev.ilce_id=ilce.id
INNER JOIN kisi ON kisi.id=ev.kisi_id
ORDER BY ev.id ASC;");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    function kisiEvleri($id)
    {
        $sth = $this->conn->prepare("SELECT ev.id,ev.durum,ev.adres,ev.m2,il.il,ilce.ilce,ev.odasayisi
FROM ev 
INNER JOIN il ON il.id=ev.il_id
INNER JOIN ilce ON ev.ilce_id=ilce.id
INNER JOIN kisi ON kisi.id=ev.kisi_id
WHERE kisi.id = ? ;");
        $sth->execute([$id]);
        $result = $sth->fetchAll();
        return $result;
    }


    function evGuncelle($il_id, $ilce_id, $adres, $durum, $m2, $id)
    {
        $sth = $this->conn->prepare(" UPDATE ev SET durum = ?,il_id = ?, ilce_id = ?, adres = ? ,m2 = ? WHERE id = ?");
        $flag = $sth->execute([$il_id, $ilce_id, $adres, $durum, $m2, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }





    function evEkle($kisi_id, $il_id, $ilce_id, $adres, $durum, $m2)
    {
        $sth = $this->conn->prepare("INSERT INTO ev
		(`kisi_id`,`il_id`,`ilce_id`,`adres`,`durum`,`m2`)
		VALUES (?,?,?,?,?,?)");
        $flag = $sth->execute([$kisi_id, $il_id, $ilce_id, $adres, $durum, $m2]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }







    function evGetir($id)
    {
        $sth = $this->conn->prepare("SELECT ev.id,il.id as il_id,il.il,ilce.ilce,ilce.id as ilce_id,ev.adres
FROM ev
INNER JOIN il ON il.id=ev.il_id
INNER JOIN ilce ON ev.ilce_id=ilce.id
INNER JOIN kisi ON kisi.id=ev.kisi_id
WHERE ev.id = ?");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }




    function evSil($id)
    {
        $sth = $this->conn->prepare("DELETE FROM ev WHERE ev.id = ?");
        $flag = $sth->execute([$id]);

        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function evAra($kisi_ad,$kisi_soyad,$adres ,$il,$ilce,$m2,$odasayisi,$durum){
        $kisi_ad = "%" .$kisi_ad. "%";
        $kisi_soyad = "%" .$kisi_soyad. "%";
        $adres = "%" .$adres. "%";
        $m2 = "%" .$m2. "%";
        $odasayisi = "%" .$odasayisi. "%";
        $durum = "%" .$durum. "%";

        $sql = "SELECT kisi.kisi_ad, kisi.kisi_soyad, il.il, ilce.ilce , ev.adres, ev.m2, ev.odasayisi, ev.durum FROM ev 
INNER JOIN kisi ON kisi.id = ev.kisi_id
INNER JOIN il ON ev.il_id = il.id
INNER JOIN ilce ON ev.ilce_id= ilce.id
WHERE kisi_ad LIKE :kisi_ad AND kisi_soyad LIKE :kisi_soyad AND adres LIKE :adres AND m2 LIKE :m2 AND odasayisi LIKE :odasayisi AND durum LIKE :durum  ";
        if($il != ''){
            $sql = $sql." AND kisi.il_id = :il_id";
        }
        if($ilce != ''){
            $sql = $sql." AND kisi.ilce_id= :ilce_id";
        }
        $sth =$this->conn->prepare($sql);
        $sth->bindParam(':kisi_ad', $kisi_ad, PDO::PARAM_STR);
        $sth->bindParam(':kisi_soyad', $kisi_soyad, PDO::PARAM_STR);
        $sth->bindParam(':adres', $adres, PDO::PARAM_STR);
        $sth->bindParam(':m2', $m2, PDO::PARAM_STR);
        $sth->bindParam(':odasayisi', $odasayisi, PDO::PARAM_STR);
        $sth->bindParam(':durum', $durum, PDO::PARAM_STR);

        if($il != ''){
            $sth->bindParam(':il_id', $il, PDO::PARAM_INT);
        }
        if($ilce != ''){
            $sth->bindParam(':ilce_id', $ilce, PDO::PARAM_INT);
        }
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

}