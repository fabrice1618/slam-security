<?php
declare(strict_types = 1);

const QUERY_INSERT = "INSERT INTO user (id, email, password, role) VALUES (NULL, :email, :password, :role) ";
const QUERY_SELECT_BY_ID = "SELECT * FROM user WHERE id = :id LIMIT 1";
const QUERY_SELECT_EMAIL = "SELECT * FROM user WHERE email = :email LIMIT 1";
const QUERY_UPDATE = "UPDATE user SET email = :email, password = :password, role = :role, WHERE id = :id";
const QUERY_DELETE = "DELETE FROM user WHERE id = :id ";

class User extends Model
{
    private int $id;
    private string $email;
    private int $role;
    private string $password;



    public function create(): void
    {
        $stmt1 = $this->pdo->prepare(QUERY_INSERT);
        $stmt1->bindValue(':email', $this->email);
        $stmt1->bindValue(':password', $this->password);
        $stmt1->bindValue(':role', $this->role);
        if ($stmt1->execute()) {
            $this->id = (int)$this->pdo->lastInsertId();
        }
    }

    public function findByEmail(string $email): bool
    {
        $stmt1 = $this->pdo->prepare(QUERY_SELECT_EMAIL);
        $stmt1->bindValue(':email', $email);
        if ($stmt1->execute()) {
            $response = $stmt1->fetch(PDO::FETCH_ASSOC);
            if($response){

                $this->data = $response;
                $this->id = $this->data["id"];
                $this->email = $this->data["email"];
                $this->password = $this->data["password"];
                $this->role = $this->data["role"];
                return true;
            }
        }
        return false;
    }

    public function read()
    {
        $stmt1 = $this->pdo->prepare(QUERY_SELECT_BY_ID);
        $stmt1->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            $this->data = $stmt1->fetch(PDO::FETCH_ASSOC);
            $this->id = $this->data["id"];
            $this->email = $this->data["email"];
            $this->password = $this->data["password"];
            $this->role = $this->data["role"];
        }
    }

    public function update(): bool
    {
        $stmt1 = $this->pdo->prepare(QUERY_UPDATE);
        $stmt1->bindValue(':role', $this->role);
        $stmt1->bindValue(':email', $this->email);
        $stmt1->bindValue(':password', $this->password);
        $stmt1->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            return true;
        }
        return false;
    }

    public function delete()
    {
        $stmt1 = $this->pdo->prepare(QUERY_DELETE);
        $stmt1->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            return true;
        }
        return false;
    }

    public function setRandomPassword()
    {

        $sNewPassword = bin2hex(random_bytes(4));

        $this->password = md5($sNewPassword);

        return ($sNewPassword);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function checkCredentials(string $email, string $password, int $role): bool
    {
        return ($email === $this->email && md5($password) === $this->password && $role === $this->role);
    }





