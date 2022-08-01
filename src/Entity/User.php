<?php

namespace App\Entity;

class User
{
    private int $idUser;
    private string $nameUser;
    private string $passwordUser;

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
        return $this;
    }

    public function getNameUser()
    {
        return $this->nameUser;
    }

    public function setNameUser($nameUser)
    {
        $this->nameUser = $nameUser;
        return $this;
    }

    public function getPasswordUser()
    {
        return $this->passwordUser;
    }

    public function setPasswordUser($passwordUser)
    {
        $this->passwordUser = $passwordUser;
        return $this;
    }
}
