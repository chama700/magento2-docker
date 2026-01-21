<?php
namespace Test\CodeQuality\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    public function getMessage()
    {
        $message = 'Hello, Magento Code Quality!';
        return $message;
    }

    // Intentional code quality issues for testing:
    public function badFunction()
    {
        $a=1;
        $b=2;
        $c=$a+$b;
        return $c;
    }
}
