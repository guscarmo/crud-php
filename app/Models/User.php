<?php

class User
{
    public  function __construct()
    {
        $this->pdo = new PDO(
            "mysql:host=localhost;dbname=crud_php",
            'root',
            ''
        );
    }

    /*
     * Trazer um único usuário especifíco
     */
    public function getUser()
    {

    }

    /*
     * Traremos apenas dados do usuário AUTENTICADO
     */
    public function  getMe()
    {

    }

    /*
     * Criaremos um novo usuário baseado no registro
     */
    public function postUser(array $data): bool
    {
        try {
            $query = $this->pdo->prepare(
                'INSERT INTO users VALUES (null,:name,:email,:password, null)'
            );

            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

            $query->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $query->bindParam(':email', $data['email'], PDO::PARAM_STR);
            $query->bindParam(':password', $data['password'], PDO::PARAM_STR);
            return $query->execute();
        }catch (PDOException $exception) {
            echo "deu ruim";
            die();
        }
    }
}