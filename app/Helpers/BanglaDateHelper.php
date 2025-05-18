<?php

namespace App\Helpers;

class BanglaDateHelper
{
    public static function convertToBanglaDate($date)
    {
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 
                    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $bangla = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯',
                   'জানু', 'ফেব', 'মার্চ', 'এপ্রি', 'মে', 'জুন',
                   'জুলা', 'আগ', 'সেপ', 'অক্টো', 'নভে', 'ডিসে'];

        return str_replace($english, $bangla, $date);
    }
    
       public static function convertToBanglaDigit($number)
    {
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $banglaDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        return str_replace($englishDigits, $banglaDigits, $number);
    }
}
