<?php
declare(strict_types = 1);

const QUERY_INSERT = "INSERT INTO image (id, type, content) VALUES (NULL, :type, :content) ";
const QUERY_SELECT_BY_ID = "SELECT * FROM user WHERE id = :id LIMIT 1";
const QUERY_DELETE = "DELETE FROM image WHERE id = :id ";


class Image extends Model{

    private int $id; 
    private string $type;
    private mixed $content;

    public function create(): void
    {
        $stmt1 = $this->PDO->prepare(QUERY_INSERT);
        $stmt1->bindValue(':type', $this->type);
        $stmt1->bindValue(':content', $this->content);
        if ($stmt1->execute()) {
            $this->id = (int)$this->PDO->lastInsertId();
        }
    }

    public function read()
    {
        $stmt1 = $this->PDO->prepare(QUERY_SELECT_BY_ID);
        $stmt1->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            $this->data = $stmt1->fetch(PDO::FETCH_ASSOC);
            $this->id = $this->data["id"];
            $this->email = $this->data["type"];
            $this->password = $this->data["content"];
        }
    }

    public function delete()
    {
        $stmt1 = $this->PDO->prepare(QUERY_DELETE);
        $stmt1->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            return true;
        }
        return false;
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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getContent(): mixed
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent(mixed $content): void
    {
        $this->content = $content;
    }

}