<?php
namespace core\Services;

class UserService
{
    private int $id;
    private string $date;
    private string $userType;
    private $operationtype;
    private float $amount;
    private $currency;
	public function __construct(int $id, string $date, string $userType, string $operationtype, float $amount, $currency)
    {
        $this->id = $id;
        $this->date = $date;
        $this->userType = $userType;
        $this->operationtype = $operationtype;
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setUserType($userType)
    {
        $this->userType = $userType;
    }

    public function getUserType()
    {
        return $this->userType;
    }

    public function setOperationType($operationtype)
    {
        $this->operationtype = $operationtype;
    }

    public function getOperationType()
    {
        return $this->operationtype;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    public function getCurrency()
    {
        return $this->currency;
    }
}