<?php
/**
 * Created by PhpStorm.
 * User: Maria Gabriela
 * Date: 10/05/2018
 * Time: 10:04
 */

class state
{

    private $id_state;
    private $uf;
    private $name;
    private $region_id_region;

    /**
     * state constructor.
     * @param $id_state
     * @param $uf
     * @param $name
     * @param $region_id_region
     */
    public function __construct($id_state, $uf, $name, $region_id_region)
    {
        $this->id_state = $id_state;
        $this->uf = $uf;
        $this->name = $name;
        $this->region_id_region = $region_id_region;
    }

    /**
     * @return mixed
     */
    public function getIdState()
    {
        return $this->id_state;
    }

    /**
     * @param mixed $id_state
     */
    public function setIdState($id_state)
    {
        $this->id_state = $id_state;
    }

    /**
     * @return mixed
     */
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * @param mixed $uf
     */
    public function setUf($uf)
    {
        $this->uf = $uf;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getRegionIdRegion()
    {
        return $this->region_id_region;
    }

    /**
     * @param mixed $region_id_region
     */
    public function setRegionIdRegion($region_id_region)
    {
        $this->region_id_region = $region_id_region;
    }




}