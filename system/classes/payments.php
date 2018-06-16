<?php
/**
 * Created by PhpStorm.
 * User: Maria Gabriela
 * Date: 10/05/2018
 * Time: 09:54
 */

class payments
{

    private $id_payment;
    private $city_id_city;
    private $functions_id_function;
    private $subfunctions_id_subfunction;
    private $program_id_program;
    private $action_id_action;
    private $beneficiaries_id_beneficiaries;
    private $source_id_source;
    private $files_id_files;
    private $month;
    private $year;
    private $value;

    /**
     * payments constructor.
     * @param $id_payment
     * @param $city_id_city
     * @param $functions_id_function
     * @param $subfunctions_id_subfunction
     * @param $program_id_program
     * @param $action_id_action
     * @param $beneficiaries_id_beneficiaries
     * @param $source_id_source
     * @param $files_id_files
     * @param $month
     * @param $year
     * @param $value
     */
    public function __construct($id_payment, $city_id_city, $functions_id_function, $subfunctions_id_subfunction, $program_id_program, $action_id_action, $beneficiaries_id_beneficiaries, $source_id_source, $files_id_files, $month, $year, $value)
    {
        $this->id_payment = $id_payment;
        $this->city_id_city = $city_id_city;
        $this->functions_id_function = $functions_id_function;
        $this->subfunctions_id_subfunction = $subfunctions_id_subfunction;
        $this->program_id_program = $program_id_program;
        $this->action_id_action = $action_id_action;
        $this->beneficiaries_id_beneficiaries = $beneficiaries_id_beneficiaries;
        $this->source_id_source = $source_id_source;
        $this->files_id_files = $files_id_files;
        $this->month = $month;
        $this->year = $year;
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getIdPayment()
    {
        return $this->id_payment;
    }

    /**
     * @param mixed $id_payment
     */
    public function setIdPayment($id_payment)
    {
        $this->id_payment = $id_payment;
    }

    /**
     * @return mixed
     */
    public function getCityIdCity()
    {
        return $this->city_id_city;
    }

    /**
     * @param mixed $city_id_city
     */
    public function setCityIdCity($city_id_city)
    {
        $this->city_id_city = $city_id_city;
    }

    /**
     * @return mixed
     */
    public function getFunctionsIdFunction()
    {
        return $this->functions_id_function;
    }

    /**
     * @param mixed $functions_id_function
     */
    public function setFunctionsIdFunction($functions_id_function)
    {
        $this->functions_id_function = $functions_id_function;
    }

    /**
     * @return mixed
     */
    public function getSubfunctionsIdSubfunction()
    {
        return $this->subfunctions_id_subfunction;
    }

    /**
     * @param mixed $subfunctions_id_subfunction
     */
    public function setSubfunctionsIdSubfunction($subfunctions_id_subfunction)
    {
        $this->subfunctions_id_subfunction = $subfunctions_id_subfunction;
    }

    /**
     * @return mixed
     */
    public function getProgramIdProgram()
    {
        return $this->program_id_program;
    }

    /**
     * @param mixed $program_id_program
     */
    public function setProgramIdProgram($program_id_program)
    {
        $this->program_id_program = $program_id_program;
    }

    /**
     * @return mixed
     */
    public function getActionIdAction()
    {
        return $this->action_id_action;
    }

    /**
     * @param mixed $action_id_action
     */
    public function setActionIdAction($action_id_action)
    {
        $this->action_id_action = $action_id_action;
    }

    /**
     * @return mixed
     */
    public function getBeneficiariesIdBeneficiaries()
    {
        return $this->beneficiaries_id_beneficiaries;
    }

    /**
     * @param mixed $beneficiaries_id_beneficiaries
     */
    public function setBeneficiariesIdBeneficiaries($beneficiaries_id_beneficiaries)
    {
        $this->beneficiaries_id_beneficiaries = $beneficiaries_id_beneficiaries;
    }

    /**
     * @return mixed
     */
    public function getSourceIdSource()
    {
        return $this->source_id_source;
    }

    /**
     * @param mixed $source_id_source
     */
    public function setSourceIdSource($source_id_source)
    {
        $this->source_id_source = $source_id_source;
    }

    /**
     * @return mixed
     */
    public function getFilesIdFiles()
    {
        return $this->files_id_files;
    }

    /**
     * @param mixed $files_id_files
     */
    public function setFilesIdFiles($files_id_files)
    {
        $this->files_id_files = $files_id_files;
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

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

}