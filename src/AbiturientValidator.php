<?php

namespace MyLibrary;

mb_internal_encoding('utf-8');

 /**
  * Класс проверки введеных данных об абитуриенты.
  */
 class AbiturientValidator
 {
     public function __construct(Abiturient $abiturient)
     {
         if (empty($abiturient->getVar('firstname'))) {
             $this->firstname = 'Не заполнено поле "Имя".';
         } elseif (mb_strlen($abiturient->getVar('firstname')) > 50) {
             $this->firstname = 'Поле "Имя" может содержать не более 50 символов.';
         } elseif (!preg_match('/^[а-яёa-z](([\s-_\'\.]?[0-9а-яёa-z]+)*)$/ui', $abiturient->getVar('firstname'))) {
             $this->firstname = 'Поле "Имя" может содержать не более 50 символов: русские или латинские буквы, цифры или некоторые спецсимволы.';
         }
         if (empty($abiturient->getVar('lastname'))) {
             $this->lastname = 'Не заполнено поле "Фамилия".';
         } elseif (mb_strlen($abiturient->getVar('lastname')) > 50) {
             $this->lastname = 'Поле "Фамилия" может содержать не более 50 символов.';
         } elseif (!preg_match('/^[а-яёa-z](([\s-_\'\.]?[0-9а-яёa-z]+)*)$/ui', $abiturient->getVar('lastname'))) {
             $this->lastname = 'Поле "Фамилия" может содержать не более 50 символов: русские или латинские буквы, цифры или некоторые спецсимволы.';
         }
         if (!preg_match('/^[12]$/ui', $abiturient->getVar('gender'))) {
             $this->gender = 'Не выбрано значение для поля "Пол".';
         }
         if (empty($abiturient->getVar('group_n'))) {
             $this->group_n = 'Не заполнено поле "Группа".';
         } elseif (mb_strlen($abiturient->getVar('group_n')) > 5) {
             $this->group_n = 'Поле "Группа" должна содержать от 2 до 5 символов.';
         } elseif (!preg_match('/^[а-яёa-z0-9]+$/ui', $abiturient->getVar('group_n'))) {
             $this->group_n = 'Поле "Группа" может содержать только русские или латинские буквы и цифры.';
         }
         if (empty($abiturient->getVar('email'))) {
             $this->email = 'Не заполнено поле "Email".';
         } elseif (mb_strlen($abiturient->getVar('lastname')) > 255) {
             $this->lastname = 'Поле "Email" может содержать не более 255 символов.';
         } elseif (!preg_match('/.+@.+\..+/ui', $abiturient->getVar('email'))) {
             $this->email = 'Поле "Email" может содержать латинские буквы, цифры и некоторые спецсимволы.';
         }
         if (empty($abiturient->getVar('ege'))) {
             $this->ege = 'Не заполнено поле "Сумма баллов ЕГЭ".';
         } elseif (!preg_match('/^[0-9]+$/ui', $abiturient->getVar('ege'))) {
             $this->ege = 'Поле "Сумма баллов ЕГЭ" может содержать только цифры.';
         } elseif ($abiturient->getVar('ege') > 300) {
             $this->ege = 'В поле "Сумма баллов ЕГЭ" не может быть число больше 300.';
         }
         if (empty($abiturient->getVar('year_b'))) {
             $this->year_b = 'Не заполнено поле "Год рождения".';
         } elseif (!preg_match('/^[0-9]{4}$/ui', $abiturient->getVar('year_b'))) {
             $this->year_b = 'Поле "Год рождения" должно содержать 4 цифры.';
         }
         if (!preg_match('/^[12]$/ui', $abiturient->getVar('registration'))) {
             $this->registration = 'Не выбрано значение для поля "Прописка".';
         }
     }
 }
