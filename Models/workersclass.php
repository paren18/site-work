<?php

class Worker {
    public $name;
    public $work;
    public $birthday;
    public $year;
    public function __construct($name,$work,$birthday,$year){

        $this->name = $name;
        $this->work = $work;
        $this->birthday = $birthday;
        $this->year = $year;

        if ($year > 0){

            $currentYear = date("Y");
            $this->experience = $currentYear - $year;
        }
        if ($birthday > 0){

            $currentYear = date("Y");
            $birthTimestamp = strtotime($birthday);
            $birth = date('Y', $birthTimestamp);
            $this->age = $currentYear - $birth;
        }

    }

}