<?php
/**
 * Created by PhpStorm.
 * User: Maria Gabriela
 * Date: 10/05/2018
 * Time: 10:03
 */

class source
{

    private $id_source;
    private $goal;
    private $origin;
    private $periodicity;

    /**
     * source constructor.
     * @param $id_source
     * @param $goal
     * @param $origin
     * @param $periodicity
     */
    public function __construct($id_source, $goal, $origin, $periodicity)
    {
        $this->id_source = $id_source;
        $this->goal = $goal;
        $this->origin = $origin;
        $this->periodicity = $periodicity;
    }

    /**
     * @return mixed
     */
    public function getIdSource()
    {
        return $this->id_source;
    }

    /**
     * @param mixed $id_source
     */
    public function setIdSource($id_source)
    {
        $this->id_source = $id_source;
    }

    /**
     * @return mixed
     */
    public function getGoal()
    {
        return $this->goal;
    }

    /**
     * @param mixed $goal
     */
    public function setGoal($goal)
    {
        $this->goal = $goal;
    }

    /**
     * @return mixed
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @param mixed $origin
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;
    }

    /**
     * @return mixed
     */
    public function getPeriodicity()
    {
        return $this->periodicity;
    }

    /**
     * @param mixed $periodicity
     */
    public function setPeriodicity($periodicity)
    {
        $this->periodicity = $periodicity;
    }




}