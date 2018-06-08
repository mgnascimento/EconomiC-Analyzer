<?php
/**
 * Created by PhpStorm.
 * User: Maria Gabriela
 * Date: 10/05/2018
 * Time: 10:01
 */

class program
{

    private $id_program;
    private $cod_program;
    private $name_program;

    /**
     * program constructor.
     * @param $id_program
     * @param $cod_program
     * @param $name_program
     */
    public function __construct($id_program, $cod_program, $name_program)
    {
        $this->id_program = $id_program;
        $this->cod_program = $cod_program;
        $this->name_program = $name_program;
    }

    /**
     * @return mixed
     */
    public function getIdProgram()
    {
        return $this->id_program;
    }

    /**
     * @param mixed $id_program
     */
    public function setIdProgram($id_program)
    {
        $this->id_program = $id_program;
    }

    /**
     * @return mixed
     */
    public function getCodProgram()
    {
        return $this->cod_program;
    }

    /**
     * @param mixed $cod_program
     */
    public function setCodProgram($cod_program)
    {
        $this->cod_program = $cod_program;
    }

    /**
     * @return mixed
     */
    public function getNameProgram()
    {
        return $this->name_program;
    }

    /**
     * @param mixed $name_program
     */
    public function setNameProgram($name_program)
    {
        $this->name_program = $name_program;
    }




}