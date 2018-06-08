<?php
/**
 * Created by PhpStorm.
 * User: Maria Gabriela
 * Date: 10/05/2018
 * Time: 09:50
 */

class files
{

    private $id_files;
    private $name_files;
    private $month;
    private $year;

    /**
     * files constructor.
     * @param $id_files
     * @param $name_files
     * @param $month
     * @param $year
     */
    public function __construct($id_files, $name_files, $month, $year)
    {
        $this->id_files = $id_files;
        $this->name_files = $name_files;
        $this->month = $month;
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getIdFiles()
    {
        return $this->id_files;
    }

    /**
     * @param mixed $id_files
     */
    public function setIdFiles($id_files)
    {
        $this->id_files = $id_files;
    }

    /**
     * @return mixed
     */
    public function getNameFiles()
    {
        return $this->name_files;
    }

    /**
     * @param mixed $name_files
     */
    public function setNameFiles($name_files)
    {
        $this->name_files = $name_files;
    }

    /**
     * @return mixed
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @param mixed $month
     */
    public function setMonth($month)
    {
        $this->month = $month;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }




}