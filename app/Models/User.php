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
    public function getUser(string $value, string $field = "id" ): array
    {
        $query = $this->pdo->prepare(
          "SELECT * FROM users WHERE $field = :value"
        );

        $query->bindParam(':value', $value, PDO::PARAM_STR);
        $query->execute();

        $user = $query->fetch(PDO::FETCH_ASSOC);
        return $user ? $user : [];
    }

    /*
     * Traremos apenas dados do usuário AUTENTICADO
     */
    public function  getMe()
    {
        $query = $this->pdo->prepare(
            "SELECT * FROM users WHERE id = :value"
        );

        $query->bindParam(':value', $_SESSION['id'], PDO::PARAM_STR);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
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

    public function putUseR()
    {

    }
}