<?php
/**
 * Created by PhpStorm.
 * User: Maria Gabriela
 * Date: 14/06/2018
 * Time: 18:12
 */

class usuario
{
    private $idUsuario;
    private $Usuario;
    private $Senha;
    private $Nome;
    private $Email;
    private $Resetar;

    /**
     * usuario constructor.
     * @param $idUsuario
     * @param $Usuario
     * @param $Senha
     * @param $Nome
     * @param $Email
     * @param $Resetar
     */
    public function __construct($idUsuario, $Usuario, $Senha, $Nome, $Email, $Resetar)
    {
        $this->idUsuario = $idUsuario;
        $this->Usuario = $Usuario;
        $this->Senha = $Senha;
        $this->Nome = $Nome;
        $this->Email = $Email;
        $this->Resetar = $Resetar;
    }

    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * @param mixed $idUsuario
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->Usuario;
    }

    /**
     * @param mixed $Usuario
     */
    public function setUsuario($Usuario)
    {
        $this->Usuario = $Usuario;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->Senha;
    }

    /**
     * @param mixed $Senha
     */
    public function setSenha($Senha)
    {
        $this->Senha = $Senha;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->Nome;
    }

    /**
     * @param mixed $Nome
     */
    public function setNome($Nome)
    {
        $this->Nome = $Nome;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * @param mixed $Email
     */
    public function setEmail($Email)
    {
        $this->Email = $Email;
    }

    /**
     * @return mixed
     */
    public function getResetar()
    {
        return $this->Resetar;
    }

    /**
     * @param mixed $Resetar
     */
    public function setResetar($Resetar)
    {
        $this->Resetar = $Resetar;
    }



}