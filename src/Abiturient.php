<?php

namespace MyLibrary;

/**
 * Класс модели абитуриента.
 */
class Abiturient
{
    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';
    const REGISTRATION_LOCAL = 'local';
    const REGISTRATION_NONRESIDENT = 'nonresident';
    private $firstname = '';
    private $lastname = '';
    private $gender = '';
    private $group_n = '';
    private $email = '';
    private $ege = '';
    private $year_b = '';
    private $registration = '';

    public function __construct()
    {
        if (!empty($this->gender)) {
            $this->gender = $this->gender == $this::GENDER_MALE ? 1 : 2;
        }
        if (!empty($this->registration)) {
            $this->registration = $this->registration == $this::REGISTRATION_LOCAL ? 1 : 2;
        }
    }

  /**
   * Установить параметр
   */
  public function setVar($var, $value)
  {
      if (isset($this->$var)) {
          $this->$var = trim(strval($value));
      }
  }

  /**
   * Взять параметр
   */
  public function getVar($var)
  {
      return $this->$var;
  }
}
