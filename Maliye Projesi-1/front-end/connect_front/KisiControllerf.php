<?php


class KisiControllerf extends DBControllerf
{
    function kisileriGetir()
    {
        $sth = $this->conn->prepare("SELECT kisi.id,kisi.kisi_ad,kisi.kisi_soyad,il.il,ilce.ilce,kisi.tc_no
from kisi
inner join il ON il.id=kisi.il_id
inner join ilce ON kisi.ilce_id=ilce.id
order by kisi.id ASC");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    function kisiAra($kisi_ad,$kisi_soyad,$tc_no,$il,$ilce){
        $kisi_ad = "%" .$kisi_ad. "%";
        $kisi_soyad = "%" .$kisi_soyad. "%";
        $tc_no= "%" .$tc_no. "%";

        $sql="SELECT kisi.kisi_ad,kisi.kisi_soyad, kisi.tc_no ,il.il,ilce.ilce FROM kisi
INNER JOIN il ON kisi.il_id=il.id
INNER JOIN ilce ON kisi.ilce_id=ilce.id 
WHERE kisi_ad LIKE :kisi_ad AND kisi_soyad LIKE :kisi_soyad AND tc_no LIKE :tc_no ";

        if($il != ''){
            $sql = $sql." AND kisi.il_id = :il_id";
        }
        if($ilce != ''){
            $sql = $sql." AND kisi.ilce_id= :ilce_id";
        }

        $sth=$this->conn->prepare($sql);

        $sth->bindParam(':kisi_ad', $kisi_ad, PDO::PARAM_STR);
        $sth->bindParam(':kisi_soyad', $kisi_soyad, PDO::PARAM_STR);
        $sth->bindParam(':tc_no', $tc_no, PDO::PARAM_STR);
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

    function kisiBul($id)
    {
        $sth = $this->conn->prepare("SELECT * FROM kisi WHERE id=?");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }
}