<?php


class FormTest extends PHPUnit_Framework_TestCase
{

    public function testPhoneStrNotEmpty()
    {

        $this->assertTrue(Form::is_phone("+ 7 (918) 382 - 2970"));
    }

    public function testPhoneStrEmpty()
    {

        $this->assertNotTrue(Form::is_phone(""));

    }

}