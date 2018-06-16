<?php
/**
 * Created by PhpStorm.
 * User: Maria Gabriela
 * Date: 10/05/2018
 * Time: 10:02
 */

class region
{
    private $id_region;
    private $name_region;

    /**
     * region constructor.
     * @param $id_region
     * @param $name_region
     */
    public function __construct($id_region, $name_region)
    {
        $this->id_region = $id_region;
        $this->name_region = $name_region;
    }

    /**
     * @return mixed
     */
    public function getIdRegion()
    {
        return $this->id_region;
    }

    /**
     * @param mixed $id_region
     */
    public function setIdRegion($id_region)
    {
        $this->id_region = $id_region;
    }

    /**
     * @return mixed
     */
    public function getNameRegion()
    {
        return $this->name_region;
    }

    /**
     * @param mixed $name_region
     */
    public function setNameRegion($name_region)
    {
        $this->name_region = $name_region;
    }




}