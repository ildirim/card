<?php
namespace core\Services;
use WithdrawConstant;
use core\Services\CalculationService;

class WithdrawService extends CalculationService
{
	public function calculateFeeBusiness(float $amount, string $currency)
    {
        $commissionFee = $amount * WithdrawConstant::BUSINESS_FEE / 100;
        
        return round($commissionFee, 2);
    }

	public function calculateFeePrivate(string $date, string $userType, string $operationType, float $amount, string $currency, array $userOperations)
	{
        $data = $this->checkPrivate($userOperations);
        $commissionFee = 0;

        if($data['countOfOperations'] > WithdrawConstant::FREE_OF_CHARGE_COUNT)
		    $commissionFee = $amount * WithdrawConstant::PRIVATE_FEE / 100;
        elseif($data['sumAmount'] > 1000 && $data['countOfOperations'] > WithdrawConstant::MIN_OPERATIONS_COUNT)
		    $commissionFee = $amount * WithdrawConstant::PRIVATE_FEE / 100;
        elseif($data['sumAmount'] > 1000)
		    $commissionFee = ($amount - 1000) * WithdrawConstant::PRIVATE_FEE / 100;

        return round($commissionFee, 2);
	}

    public function checkPrivate($userOperations)
    {
        $countOfOperations = 0;
        $sumAmount = 0;
        if(!empty($userOperations))
        {
            $count = count($userOperations);
            $lastOperation = $userOperations[$count - 1];
            $operationDay = date('w', strtotime($lastOperation->getDate()));
            $operationDay = $operationDay == 0 ? 7 : $operationDay;
            foreach($userOperations as $userOperation)
            {
                $d = $operationDay - 1;
                $firstDay = date('Y-m-d', strtotime($lastOperation->getDate() . ' -' . $d . ' days'));
                if($userOperation->getDate() >= $firstDay)
                {
                    $countOfOperations++;
                    $sumAmount += $userOperation->getAmount();
                }
            }
        }

        return [
            'sumAmount' => $sumAmount,
            'countOfOperations' => $countOfOperations
        ];
    }
}