<?php
/**
 * Created by PhpStorm.
 * User: Maria Gabriela
 * Date: 10/05/2018
 * Time: 09:47
 */

class beneficiaries
{
    private $id_beneficiaries;
    private $nis;
    private $name_person;

    /**
     * beneficiaries.php constructor.
     * @param $id_beneficiaries
     * @param $nis
     * @param $name_person
     */
    public function __construct($id_beneficiaries, $nis, $name_person)
    {
        $this->id_beneficiaries = $id_beneficiaries;
        $this->nis = $nis;
        $this->name_person = $name_person;
    }

    /**
     * @return mixed
     */
    public function getIdBeneficiaries()
    {
        return $this->id_beneficiaries;
    }

    /**
     * @param mixed $id_beneficiaries
     */
    public function setIdBeneficiaries($id_beneficiaries)
    {
        $this->id_beneficiaries = $id_beneficiaries;
    }

    /**
     * @return mixed
     */
    public function getNis()
    {
        return $this->nis;
    }

    /**
     * @param mixed $nis
     */
    public function setNis($nis)
    {
        $this->nis = $nis;
    }

    /**
     * @return mixed
     */
    public function getNamePerson()
    {
        return $this->name_person;
    }

    /**
     * @param mixed $name_person
     */
    public function setNamePerson($name_person)
    {
        $this->name_person = $name_person;
    }




}