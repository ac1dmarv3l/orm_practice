<?php

namespace ac1dmarv3l\orm_practice;

use ac1dmarv3l\orm_practice\models\User;
use PDO;

class UserMapper
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findById(int $id): ?User
    {
        $query = $this->connection->prepare("SELECT * FROM users WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return new User($result['id'], $result['name'], $result['email']);
        }

        return null;
    }

    public function save(User $user): void
    {
        if ($user->getId() === 0) {
            // create a new user
            $name = $user->getName();
            $email = $user->getEmail();
            $query = $this->connection->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
            $query->bindParam(':name', $name(), PDO::PARAM_STR);
            $query->bindParam(':email', $email(), PDO::PARAM_STR);
            $query->execute();

            // set ID for a new user
            $user->setId((int)$this->connection->lastInsertId());
        } else {
            // update an existing user
            $id = $user->getId();
            $name = $user->getName();
            $email = $user->getEmail();
            $query = $this->connection->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->bindParam(':name', $name, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->execute();
        }
    }

    public function delete(User $user): void
    {
        $id = $user->getId();
        $query = $this->connection->prepare("DELETE FROM users WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
    }
}
