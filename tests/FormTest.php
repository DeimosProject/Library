<?php


class FormTest extends PHPUnit_Framework_TestCase
{

    public function testPhoneStrNotEmpty()
    {

        $this->assertTrue(Library::is_phone("+ 7 (918) 382 - 2970"));
        $this->assertTrue(Library::is_phone("9183822970"));
        $this->assertTrue(Library::is_phone("8 (918)! 382 - 2970"));
        $this->assertTrue(Library::is_phone("+ 7 (918) 382 - 2970"));
        $this->assertTrue(Library::is_phone("+ 7 (918)@# 382 - 2970"));

    }

    public function testPhoneStrEmpty()
    {

        $this->assertNotTrue(Library::is_phone(""));

    }

}