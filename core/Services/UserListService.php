<?php
namespace core\Services;

class UserListService
{
    private array $users = [];

    public function setUser(UserService $user)
    {
        if(!in_array($user, $this->getUsers()))
            return $this->users[$user->getId()][] = $user;
        
        return false;
    }

    public function calculateFee(UserService $user)
    {
        $userOperations = $this->users[$user->getId()];
        if(!empty($userOperations))
        {
            $count = count($userOperations);
            $userOperations[$count - 1];
        }
    }

    public function getUsers()
    {
        return $this->users;
    }
}