<?php


class FormTest extends PHPUnit_Framework_TestCase
{

    public function testPhoneStrNotEmpty()
    {

        $this->assertTrue(Form::is_phone("+ 7 (918) 382 - 2970"));
        $this->assertTrue(Form::is_phone("+ 7 (9 18) 382 - 2970"));
        $this->assertTrue(Form::is_phone("+ 7 (918) 382 - 2970"));
        $this->assertTrue(Form::is_phone("+ 7 (91    8) 382 - 2970"));
        $this->assertTrue(Form::is_phone("+ 7 (918) 382 - 2970"));
        $this->assertTrue(Form::is_phone("+ 7 (91      8)##@***--- 382 - 29###@#$%^&*()70"));
        $this->assertTrue(Form::is_phone("+ 7 (918@38 - 29qwerty70"));

    }

    public function testPhoneStrEmpty()
    {

        $this->assertNotTrue(Form::is_phone(""));

    }

}