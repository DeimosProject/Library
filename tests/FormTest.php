<?php

namespace tests;

include_once "autoload.php";

use Deimos\Form;

class FormTest extends \PHPUnit_Framework_TestCase
{

    public function testEmailStrNotEmpty()
    {
        $emails = array(
            '' => false,
            'почта@привет.мир' => true,
            'maksim.babichev95@gmail.com' => true,
            'ad@spa.com' => true,
            '(comment)localpart@example.com' => false,
            'localpart.ending.with.dot.@example.com' => false,
            '"this is v@lid!"@example.com' => false,
            '"much.more unusual"@example.com' => false,
            'postbox@com' => false,
            'admin@mailserver1' => false,
            '"()<>[]:,;@\\"\\\\!#$%&\'*+-/=?^_`{}| ~.a"@example.org' => false,
            '" "@example.org' => false,
            '0hot\'mail_check@hotmail.com' => true
        );

        foreach($emails as $email => $result) {
            $f = new Form(['email' => $email]);
            $this->assertEquals($result, $f->is_valid());
        }

    }

    public function testPhoneStrNotEmpty()
    {
        $phones = array(
            "+ 7 (918) 382 - 2970",
            "9183822970",
            "8 (918)! 382 - 2970",
            "+ 7 (918) 382 - 2970",
            "+ 7 (918)@# 382 - 2970"
        );

        foreach ($phones as $phone) {
            $form = new Form(array('phone' => $phone));
            $this->assertTrue($form->is_valid());
        }
    }

    public function testPhoneStrEmpty()
    {
        $form = new Form(['phone' => '']);
        $this->assertFalse($form->is_valid());
    }

}