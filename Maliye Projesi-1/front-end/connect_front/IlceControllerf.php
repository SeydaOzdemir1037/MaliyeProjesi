<?php


class IlceControllerf extends DBControllerf
{
    function ilceleriGetir()
    {
        $sth = $this->conn->prepare("SELECT * FROM ilce order by id ASC;");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }
    function ilcebul($ilid)
    {
        $sth = $this->conn->prepare("SELECT * FROM ilce WHERE il_plaka = ? order by id ASC;");
        $sth->execute([$ilid]);
        $result = $sth->fetchAll();
        return $result;
    }

    function ilceBilgileri($id){
        $sth=$this->conn->prepare("SELECT * FROM ilce WHERE id = ?");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;

    }

}