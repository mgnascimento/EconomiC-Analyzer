<?php
/**
 * Created by PhpStorm.
 * User: Maria Gabriela
 * Date: 10/05/2018
 * Time: 09:44
 */

class action
{
    private $id_action;
    private $cod_action;
    private $name_action;

    /**
     * action constructor.
     * @param $id_action
     * @param $cod_action
     * @param $name_action
     */
    public function __construct($id_action, $cod_action, $name_action)
    {
        $this->id_action = $id_action;
        $this->cod_action = $cod_action;
        $this->name_action = $name_action;
    }

    /**
     * @return mixed
     */
    public function getIdAction()
    {
        return $this->id_action;
    }

    /**
     * @param mixed $id_action
     */
    public function setIdAction($id_action)
    {
        $this->id_action = $id_action;
    }

    /**
     * @return mixed
     */
    public function getCodAction()
    {
        return $this->cod_action;
    }

    /**
     * @param mixed $cod_action
     */
    public function setCodAction($cod_action)
    {
        $this->cod_action = $cod_action;
    }

    /**
     * @return mixed
     */
    public function getNameAction()
    {
        return $this->name_action;
    }

    /**
     * @param mixed $name_action
     */
    public function setNameAction($name_action)
    {
        $this->name_action = $name_action;
    }





}