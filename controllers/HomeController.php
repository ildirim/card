<?php
namespace controllers;

use core\Services\CalculationService;
use core\Services\UserListService;
use core\Services\UserService;
use core\Services\DepositService;
use core\Services\WithdrawService;
use UserTypeConstant;
use core\Services\RateService;

class HomeController
{
	public function __construct($url)
	{
		$this->$url();
	}

	public function index()
	{
		$data = [
			["2014-12-31",4,"private","withdraw",1200.00,"EUR"],
			["2015-01-01",4,"private","withdraw",1000.00,"EUR"],
			["2016-01-05",4,"private","withdraw",1000.00,"EUR"],
			["2016-01-05",1,"private","deposit",200.00,"EUR"],
			["2016-01-06",2,"business","withdraw",300.00,"EUR"],
			["2016-01-06",1,"private","withdraw",30000,"JPY"],
			["2016-01-07",1,"private","withdraw",1000.00,"EUR"],
			["2016-01-07",1,"private","withdraw",100.00,"USD"],
			["2016-01-10",1,"private","withdraw",100.00,"EUR"],
			["2016-01-10",2,"business","deposit",10000.00,"EUR"],
			["2016-01-10",3,"private","withdraw",1000.00,"EUR"],
			["2016-02-15",1,"private","withdraw",300.00,"EUR"],
			["2016-02-19",5,"private","withdraw",3000000,"JPY"]
		];
		$userListService = new UserListService();
		foreach($data as $request)
		{
			$amount = $request[4];
			$currency = $request[5];
			$rateService = new RateService();
			$amount = $rateService->convert($amount, $currency); 

			$userService = new UserService($request[1], $request[0], $request[2], $request[3], $amount, $currency);
			$userListService->setUser($userService);
			if($request[3] == 'withdraw')
				echo $this->calculateFee(new WithdrawService(), $userService->getDate(), $userService->getUserType(), $userService->getOperationType(), $userService->getAmount(), $userService->getCurrency(), $userListService->getUsers()[$userService->getId()]) . '<br>';
			else
				echo $this->calculateFee(new DepositService(), $userService->getDate(), $userService->getUserType(), $userService->getOperationType(), $userService->getAmount(), $userService->getCurrency(), []) . '<br>';
		}
	}

	public function calculateFee(CalculationService $calculationService, string $date, string $userType, string $operationType, float $amount, string $currency, array $userOperations)
	{
		$result = $userType == UserTypeConstant::BUSINESS ? 
									$calculationService->calculateFeeBusiness($amount, $currency) : 
                                    $calculationService->calculateFeePrivate($date, $userType, $operationType, $amount, $currency, $userOperations);
		
		return number_format($result, 2, '.', '');
	}
}