<?php

namespace App\Model;

class User
{
    private string $username;
    private string $email;
    private string $password;
    private \DateTime $createdAt;
    private string $text;

    public function __construct(string $username, string $email, string $password, string $text)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->createdAt = new \DateTime();
        $this->text = $text;
    }

    // Getters
    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
    public function getText(): string
    {
        return $this->text;
    }

    // Setters
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
}
