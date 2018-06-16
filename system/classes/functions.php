<?php
/**
 * Created by PhpStorm.
 * User: Maria Gabriela
 * Date: 10/05/2018
 * Time: 09:52
 */

class functions
{

    private $id_function;
    private $cod_function;
    private  $name_function;

    /**
     * functions constructor.
     * @param $id_function
     * @param $cod_function
     * @param $name_function
     */
    public function __construct($id_function, $cod_function, $name_function)
    {
        $this->id_function = $id_function;
        $this->cod_function = $cod_function;
        $this->name_function = $name_function;
    }

    /**
     * @return mixed
     */
    public function getIdFunction()
    {
        return $this->id_function;
    }

    /**
     * @param mixed $id_function
     */
    public function setIdFunction($id_function)
    {
        $this->id_function = $id_function;
    }

    /**
     * @return mixed
     */
    public function getCodFunction()
    {
        return $this->cod_function;
    }

    /**
     * @param mixed $cod_function
     */
    public function setCodFunction($cod_function)
    {
        $this->cod_function = $cod_function;
    }

    /**
     * @return mixed
     */
    public function getNameFunction()
    {
        return $this->name_function;
    }

    /**
     * @param mixed $name_function
     */
    public function setNameFunction($name_function)
    {
        $this->name_function = $name_function;
    }




}