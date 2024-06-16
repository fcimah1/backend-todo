<?php
namespace App\Repository;
use App\DTO\UserDTO;
use App\Models\User;
use App\Repository\Interface\IUserRepository;

class UserRepository implements IUserRepository
{
    public function createUser(UserDTO $userDTO): bool
    {
        if(User::create($userDTO->toArray())){
            return true;
        }
        return false;
    }
}