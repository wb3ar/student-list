<?php

namespace MyLibrary;

/**
 * Класс генерирующий случайный пароли из букв и цифр.
 */
class PasswordGenerator
{
    /**
   *Пароль генерируеться через конструктор конструктор
   */
  public function __construct($max)
  {
      $chars = 'qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP';
      $size = mb_strlen($chars) - 1;
      $password='';
      do {
          $password .= $chars[rand(0, $size)];
      } while (--$max);
      $this->password=$password;
  }
}
