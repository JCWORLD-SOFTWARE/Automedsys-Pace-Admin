<?php

// https://rohjay.one/how-to-easily-setup-phpunit-tests-for-codeigniter-3/
// alternative https://www.youtube.com/watch?v=rq7W-rLSloA

use PHPUnit\Framework\TestCase;

class AuthuserTest extends TestCase
{
    private static $CI;

    public static function setUpBeforeClass(): void
    {
        self::$CI =& get_instance();
        self::$CI->load->helper('gmail');
    }

    public function test_SendMail()
	{
        $adminData = [
            "email" => "acidumirae@gmail.com",
            "contact" => 1,
            "prefix" => "", "1_prefix" => "",
            "firstname" => "AutoMedSys", "1_firstname" => "AutoMedSys",
            "middlename" => "", "1_middlename" => "",
            "lastname" => "Admin", "1_lastname" => "Admin",
            "suffix" => "", "1_suffix" => ""
        ];
        $adminData['html'] = 'This is a test';
        $name = 'Anatolii Okhotnikov';
        list($err,$msg,$body) = self::$CI->gmail->SendMail($adminData,$name,"Practice deployment");
        var_dump($err);
        var_dump($msg);
        var_dump($body);
        // $this->assertTrue(true);
        // $this->assertEquals($expected, $actual);
    }

}