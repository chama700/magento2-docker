<?php

namespace Test\CodeQuality\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    public function getMessage()
    {
        $message = 'Hello, Magento Code Quality test!';
        return $message;
    }

    // Corrected function for code quality
    public function addNumbers()
    {
        $firstNumber  = 1;
        $secondNumber = 2;
        $sum          = $firstNumber + $secondNumber;
        return $sum;
    }
}
