<?php


class KisiController extends DBController
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

    function kisiadsoyad()
    {
        $sth = $this->conn->prepare("SELECT * FROM kisi ORDER BY id ASC");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    function kisiEkle($kisi_ad, $kisi_soyad, $il_id, $ilce_id, $tc_no)
    {

        $sth = $this->conn->prepare("INSERT INTO kisi
		(`kisi_ad`,`kisi_soyad`,`il_id`,`ilce_id`,`tc_no`)
		VALUES (?,?,?,?,?)");
        $flag = $sth->execute([$kisi_ad, $kisi_soyad, $il_id, $ilce_id, $tc_no]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }
    function kisiBul($id)
    {

        $sth = $this->conn->prepare("SELECT * FROM kisi WHERE id=?");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }


    function kisiSil($id)
    {
        $sth = $this->conn->prepare("DELETE FROM kisi WHERE id =?");
        $flag = $sth->execute([$id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }



    function kisiGuncelle($kisi_ad, $kisi_soyad, $il_id, $ilce_id, $tc_no, $id)
    {
        $sth = $this->conn->prepare("UPDATE kisi SET kisi_ad = ?, kisi_soyad= ? , il_id =? , ilce_id = ?, tc_no =?  WHERE id=? ");
        $flag = $sth->execute([$kisi_ad, $kisi_soyad, $il_id, $ilce_id, $tc_no, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

}