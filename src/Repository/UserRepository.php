<?php

namespace App\Repository;

use PDO;
use App\Entity\User;
use App\Database\DatabaseConnection;

class UserRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DatabaseConnection::createConnection();
    }

    /**
     * Procura um usuário para o login do sistema.
     * @param  User $user Entity class User.
     * @return bool Retorna false se não existe usuário ou senha inválida ou true se corresponder os dados.
     */
    public function findOneUserForLogin(User $user)
    {
        $sql = "SELECT password FROM users WHERE username = :username";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([':username' => $user->getNameUser()]);
        $fetch = $statement->fetch(PDO::FETCH_ASSOC);
            if (password_verify($user->getPasswordUser(), $fetch['password'])) {
                return $fetch;
            }
            return false;
    }

    /**
     * Cria um usuário para o setor de admin.
     * @param User $user
     * @return void
     */
    public function createUser(User $user): void
    {
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password);";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':username' => $user->getNameUser(),
            ':password' => $user->getPasswordUser(),
        ]);
    }

    /**
     * Remover usuário cadastrado no banco de dados.
     * @param User $user
     * @return void
     */
    public function deleteUser(User $user): void
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':id' => $user->getIdUser()
        ]);
    }

    /**
     * Procura todos os usuários cadastrados no banco de dados.
     * @return array
     */
    public function findAllUsers(): array
    {
        $sql = "SELECT id, username FROM users;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $this->hydrateAllUsers($array);
    }

    /**
     * Lida com todas as linhas de arrays da função findAllUsers() do banco de dados e transforma para classe Entity User.
     * @param array $statement
     * @return array
     */
    private function hydrateAllUsers(array $statement): array
    {
        $dataList = $statement;
        $list = [];

        foreach ($dataList as $row) {
            $user = new User();
            $user->setIdUser($row['id'])
                ->setNameUser($row['username']);
            array_push($list, $user);
        }
        return $list;
    }
}
