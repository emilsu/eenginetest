<?php
namespace Eengine\Money;

final class Money
{
    private $amount;
    private $currency;

    public function __construct(float $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }
    
    public function add(Money $money)
    {
        try {
            if (strtolower($this->currency) !== strtolower($money->currency)) {
                throw new \Exception("Currencies are not the same");
            }
            $newValue = $this->amount + $money->amount;
            return new Money($newValue, $this->currency);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function sub(Money $money)
    {
        try {
            if (strtolower($this->currency) !== strtolower($money->currency)) {
                throw new \Exception("Currencies are not the same");
            }
            $newValue = $this->amount - $money->amount;
            return new Money($newValue, $this->currency);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    
    public function mul(float $multiplier)
    {
        try {
            $newValue = $this->amount * $multiplier;
            return new Money($newValue, $this->currency);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    
    public function div(float $divisor)
    {
        try {
            if ($divisor == 0) {
                throw new \DivisionByZeroError("Division by 0 is not allowed");
            }
            $newValue = $this->amount / $divisor;
            return new Money($newValue, $this->currency);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function getFormattedAmount()
    {
        return number_format($this->amount, 2, '.', ' ') . " $this->currency";
    }
}