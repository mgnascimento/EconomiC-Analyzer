<?php
/**
 * Created by PhpStorm.
 * User: Maria Gabriela
 * Date: 10/05/2018
 * Time: 10:05
 */

class subfunction
{

    private $subfunction;
    private $cod_subfunction;
    private $name_subfunction;

    /**
     * subfunction constructor.
     * @param $subfunction
     * @param $cod_subfunction
     * @param $name_subfunction
     */
    public function __construct($subfunction, $cod_subfunction, $name_subfunction)
    {
        $this->subfunction = $subfunction;
        $this->cod_subfunction = $cod_subfunction;
        $this->name_subfunction = $name_subfunction;
    }

    /**
     * @return mixed
     */
    public function getSubfunction()
    {
        return $this->subfunction;
    }

    /**
     * @param mixed $subfunction
     */
    public function setSubfunction($subfunction)
    {
        $this->subfunction = $subfunction;
    }

    /**
     * @return mixed
     */
    public function getCodSubfunction()
    {
        return $this->cod_subfunction;
    }

    /**
     * @param mixed $cod_subfunction
     */
    public function setCodSubfunction($cod_subfunction)
    {
        $this->cod_subfunction = $cod_subfunction;
    }

    /**
     * @return mixed
     */
    public function getNameSubfunction()
    {
        return $this->name_subfunction;
    }

    /**
     * @param mixed $name_subfunction
     */
    public function setNameSubfunction($name_subfunction)
    {
        $this->name_subfunction = $name_subfunction;
    }




}