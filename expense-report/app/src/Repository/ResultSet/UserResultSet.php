<?php

namespace App\Repository\ResultSet;

use App\Entity\User;

class UserResultSet
{
    public User $user;
    public string $role;

    /**
     * @param User $user
     * @param string $role
     */
    public function __construct(User $user, string $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getRole(): string
    {
        return $this->role;
    }
}
