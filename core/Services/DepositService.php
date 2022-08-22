<?php
namespace core\Services;
use DepositConstant;
use core\Services\CalculationService;

class DepositService extends CalculationService
{
	public function calculateFeeBusiness(float $amount, string $currency)
	{
		$commissionFee = $amount * DepositConstant::BUSINESS_FEE / 100;
		return round($commissionFee, 2);
	}

	public function calculateFeePrivate(string $date, string $userType, string $operationType, float $amount, string $currency, array $userOperations)
	{
		$commissionFee = $amount * DepositConstant::PRIVATE_FEE / 100;
		return round($commissionFee, 2);
	}

}