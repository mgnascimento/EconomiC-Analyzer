<?php
/**
 * Created by PhpStorm.
 * User: Maria Gabriela
 * Date: 10/05/2018
 * Time: 09:49
 */

class city
{

    private $id_city;
    private $name_city;
    private $cod_siafi_city;
    private $stade_id_state;

    /**
     * city constructor.
     * @param $id_city
     * @param $name_city
     * @param $cod_siafi_city
     * @param $stade_id_state
     */
    public function __construct($id_city, $name_city, $cod_siafi_city, $stade_id_state)
    {
        $this->id_city = $id_city;
        $this->name_city = $name_city;
        $this->cod_siafi_city = $cod_siafi_city;
        $this->stade_id_state = $stade_id_state;
    }

    /**
     * @return mixed
     */
    public function getIdCity()
    {
        return $this->id_city;
    }

    /**
     * @param mixed $id_city
     */
    public function setIdCity($id_city)
    {
        $this->id_city = $id_city;
    }

    /**
     * @return mixed
     */
    public function getNameCity()
    {
        return $this->name_city;
    }

    /**
     * @param mixed $name_city
     */
    public function setNameCity($name_city)
    {
        $this->name_city = $name_city;
    }

    /**
     * @return mixed
     */
    public function getCodSiafiCity()
    {
        return $this->cod_siafi_city;
    }

    /**
     * @param mixed $cod_siafi_city
     */
    public function setCodSiafiCity($cod_siafi_city)
    {
        $this->cod_siafi_city = $cod_siafi_city;
    }

    /**
     * @return mixed
     */
    public function getStadeIdState()
    {
        return $this->stade_id_state;
    }

    /**
     * @param mixed $stade_id_state
     */
    public function setStadeIdState($stade_id_state)
    {
        $this->stade_id_state = $stade_id_state;
    }




}