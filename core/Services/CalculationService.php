<?php
namespace core\Services;

abstract class CalculationService
{
	public abstract function calculateFeePrivate(string $date, string $userType, string $operationType, float $amount, string $currency, array $userOperations);
	
	public abstract function calculateFeeBusiness(float $amount, string $currency);
}