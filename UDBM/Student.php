<?php

class Student
{
    private mysqli $connection;

    public function __construct(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function getAll(): array
    {
        $result = $this->connection->query(
            "SELECT id, name, email, phone FROM frome ORDER BY id DESC"
        );

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function find(int $id): ?array
    {
        $statement = $this->connection->prepare(
            "SELECT id, name, email, phone FROM frome WHERE id = ?"
        );
        $statement->bind_param("i", $id);
        $statement->execute();
        $student = $statement->get_result()->fetch_assoc() ?: null;
        $statement->close();

        return $student;
    }

    public function create(string $name, string $email, string $phone): void
    {
        $statement = $this->connection->prepare(
            "INSERT INTO frome (name, email, phone) VALUES (?, ?, ?)"
        );
        $statement->bind_param("sss", $name, $email, $phone);
        $statement->execute();
        $statement->close();
    }

    public function update(int $id, string $name, string $email, string $phone): void
    {
        $statement = $this->connection->prepare(
            "UPDATE frome SET name = ?, email = ?, phone = ? WHERE id = ?"
        );
        $statement->bind_param("sssi", $name, $email, $phone, $id);
        $statement->execute();
        $statement->close();
    }

    public function delete(int $id): void
    {
        $statement = $this->connection->prepare(
            "DELETE FROM frome WHERE id = ?"
        );
        $statement->bind_param("i", $id);
        $statement->execute();
        $statement->close();
    }
}