<?php
namespace App\src\Projects\Entities;

class ProjectEntity
{
    private $id;
    private $name;
    private $description;
    private $isArchived;
    private $userId;
    private $createdAt;
    private $updatedAt;

    public function __construct(
        $id,
        $name,
        $description,
        $isArchived,
        $userId,
        $createdAt,
        $updatedAt
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->isArchived = $isArchived;
        $this->userId = $userId;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getDescription() { return $this->description; }
    public function getIsArchived() { return $this->isArchived; }
    public function getUserId() { return $this->userId; }
    public function getCreatedAt() { return $this->createdAt; }
    public function getUpdatedAt() { return $this->updatedAt; }

    public function setId($value) { $this->id = $value; }
    public function setName($value) { $this->name = $value; }
    public function setDescription($value) { $this->description = $value; }
    public function setIsArchived($value) { $this->isArchived = $value; }
    public function setUserId($value) { $this->userId = $value; }
    public function setCreatedAt($value) { $this->createdAt = $value; }
    public function setUpdatedAt($value) { $this->updatedAt = $value; }

    public function toResponse()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'isArchived' => $this->isArchived
        ];
    }

}