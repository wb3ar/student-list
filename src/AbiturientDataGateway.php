<?php

namespace MyLibrary;

/**
 * Класс, содержащий методы для работы с базой данных.
 */
class AbiturientDataGateway
{
    private $pdo;
    /**
     * Объект для работы с БД внедряется через конструктор
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Добавить абитуриента, в функцию передается объект MyLibrary\Abiturient содержащий
     * имя, фамилию и т.д.
     */
    public function addAbiturient(Abiturient $abiturient)
    {
        try {
            $query = 'INSERT INTO students (firstname, lastname, gender, group_n, email, ege, year_b, registration) values (:firstname, :lastname, :gender, :group_n, :email, :ege, :year_b, :registration)';
            $st = $this->pdo->prepare($query);
            $arr = (array) $abiturient;
            foreach ($arr as $key => $val) {
                $key = preg_replace('/.MyLibrary\\\Abiturient./ui', '', $key);
                $arr2[$key] = $val;
            }
            $arr2['gender'] = ($arr2['gender'] == 1) ? $abiturient::GENDER_MALE : $abiturient::GENDER_FEMALE;
            $arr2['registration'] = ($arr2['registration'] == 1) ? $abiturient::REGISTRATION_LOCAL : $abiturient::REGISTRATION_NONRESIDENT;
            $st->execute($arr2);

            return true;
        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                $this->error = 'Этот Email уже есть в базе.';
            } else {
                $message = 'Произошла ошибка.';
                require_once '../templates/registration.html';
                exit;
            }
        }
    }

    /**
     * Добавить абитуриента, в функцию передается пароль и объект MyLibrary\Abiturient содержащий
     * имя, фамилию и т.д.
     */
    public function updateAbiturient(Abiturient $abiturient, $pass)
    {
        try {
            $query = 'UPDATE students INNER JOIN users ON students.id=users.id SET firstname = :firstname, lastname = :lastname, gender = :gender, group_n = :group_n, email = :email, ege = :ege, year_b = :year_b, registration = :registration WHERE pass=:pass';
            $st = $this->pdo->prepare($query);
            $arr = (array) $abiturient;
            foreach ($arr as $key => $val) {
                $key = preg_replace('/.MyLibrary\\\Abiturient./ui', '', $key);
                $arr2[$key] = $val;
            }
            $arr2['gender'] = ($arr2['gender'] == 1) ? $abiturient::GENDER_MALE : $abiturient::GENDER_FEMALE;
            $arr2['registration'] = ($arr2['registration'] == 1) ? $abiturient::REGISTRATION_LOCAL : $abiturient::REGISTRATION_NONRESIDENT;
            $arr2['pass'] = $pass;
            $st->execute($arr2);

            return true;
        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                $this->error = 'Этот Email уже есть в базе.';
            } else {
                $message = 'Произошла ошибка.';
                require_once '../templates/registration.html';
                exit;
            }
        }
    }

    /**
     * Добавить пользователя в базу.
     */
    public function addUser($pass)
    {
        $id = $this->pdo->lastInsertId();
        try {
            $st = $this->pdo->prepare('INSERT INTO users (id, pass) values (:id, :pass)');
            $st->bindValue(':id', $id);
            $st->bindValue(':pass', $pass);
            $st->execute();

            return $pass;
        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                $passGen = new PasswordGenerator(32);
                $pass = $this->addUser($passGen->password);

                return $pass;
            } else {
                $message = 'Произошла ошибка.';
                require_once '../templates/registration.html';
                exit;
            }
        }
    }

    /**
     * Получить данные аббитуриента по паролю в виде объекта Abiturient или null если она не найдена.
     */
    public function getAbiturientDataById($pass)
    {
        try {
            $st = $this->pdo->prepare('SELECT firstname, lastname, gender, group_n, email, ege, year_b, registration FROM students INNER JOIN users ON students.id=users.id WHERE pass=:pass');
            $st->bindValue(':pass', $pass);
            $st->execute();
            $abiturient = $st->fetchAll(\PDO::FETCH_CLASS, 'MyLibrary\\Abiturient');

            return $abiturient[0];
        } catch (\PDOException $e) {
            $message = 'Не удалось подключиться к базе данных.';
            require_once '../templates/index.html';
            exit;
        }
    }

    /**
     * Получить данные абитуриентов из базы.
     */
    public function getAbiturients($search, $order, Pager $pager)
    {
        try {
            $order = empty($order) ? 'ege' : $order;
            $offset = $pager->getOffset();
            if (!empty($search)) {
                $search = '%'.$search.'%';
                $st = $this->pdo->prepare('select * from students where concat(firstname, lastname, gender, group_n, email, ege, year_b, registration) like :search ORDER BY '.$order.' LIMIT '.$pager->getVar('recordsPerPage').' OFFSET '.$offset);
                $st->bindValue(':search', $search);
            } else {
                $st = $this->pdo->prepare('SELECT * FROM students ORDER BY '.$order.' LIMIT '.$pager->getVar('recordsPerPage').' OFFSET '.$offset);
            }
            $st->execute();
            $abiturients = $st->fetchAll(\PDO::FETCH_CLASS, 'MyLibrary\\Abiturient');

            return $abiturients;
        } catch (\PDOException $e) {
            $message = 'Не удалось подключиться к базе данных.';
            require_once '../templates/index.html';
            exit;
        }
    }
       /**
        * Получить число абитуриентов из базы данных.
        */
       public function getCountAbiturients($search)
       {
           try {
               if (!empty($search)) {
                   $search = '%'.$search.'%';
                   $st = $this->pdo->prepare('SELECT count(*) FROM students where concat(firstname, lastname, gender, group_n, email, ege, year_b, registration) LIKE :search');
                   $st->bindValue(':search', $search);
               } else {
                   $st = $this->pdo->prepare('SELECT count(*) FROM students');
               }
               $st->execute();
               $result = $st->fetch();

               return $result[0];
           } catch (\PDOException $e) {
               $message = 'Не удалось подключиться к базе данных.';
               require_once '../templates/index.html';
               exit;
           }
       }
}
