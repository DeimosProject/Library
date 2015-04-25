<?php

namespace Deimos;

/**
 * Class Element_Form
 * @package Deimos
 */
class Element_Form
{

    /**
     * @var bool
     */
    public $validate = true;

    /**
     * @var null|string
     */
    public $msg_error = null;

    /**
     * @var null|string
     */
    public $value = null;

    /**
     * @var null|string
     */
    public $expreg = null;

    /**
     * @param $name
     * @param $data
     */
    public function __construct($name, $data, $msg_error)
    {
        $this->value = $data;

        if (method_exists($this, 'validate_' . $name))
            $this->{'validate_' . $name}();
    }

    /**
     * @return bool
     */
    public function validate_numberic()
    {
        return $this->validate_number();
    }

    /**
     * @param int $min
     * @param int $max
     * @return bool
     */
    public function validate_password($min = 8, $max = 32)
    {
        $bool = $this->validate_length($min, $max);

        $isset_char_lower = (bool)preg_match('/[а-яa-z]/u', $this->value);
        $bool = $isset_char_lower && $bool;

        $isset_char_upper = (bool)preg_match('/[А-ЯA-Z]/u', $this->value);
        $bool = $isset_char_upper && $bool;

        $isset_char_digits = (bool)preg_match('/\d/u', $this->value);
        $bool = $isset_char_digits && $bool;

        $this->validate = $bool;
        return $this->validate;
    }

    /**
     * @param Element_Form $element_form
     * @return bool
     */
    public function validate_confirm(Element_Form $element_form)
    {
        $bool = $this->validate && $element_form->validate;
        $this->validate = $bool && $element_form->value == $this->value;
        return $this->validate;
    }

    /**
     * @return bool
     */
    public function validate_number()
    {
        $this->validate = is_numeric($this->value);
        return $this->validate;
    }

    /**
     * @param int $min
     * @param null|int $max
     * @return bool
     */
    public function validate_length($min = 1, $max = null)
    {
        if ($this->value == null)
            return $this->validate = false;

        $bool = true;
        $length = mb_strlen($this->value);

        if (is_numeric($max))
            $bool = $length <= $max;

        $this->validate = $length >= $min && $bool;
        return $this->validate;
    }

    /**
     * @return bool
     */
    public function validate_expreg()
    {
        if (!$this->validate_length())
            return $this->validate;

        $length = mb_strlen($this->value);
        $bool = (bool)preg_match($this->expreg, $this->value, $out);
        $is_one = count($out) == 1;
        $bool = $bool && $is_one;

        if ($bool)
            $bool = $length == mb_strlen($out[0]);

        return $bool;
    }

    /**
     * @param null|string $msg_error
     * @return bool
     */
    public function validate_email($msg_error = null)
    {
        if (!$this->validate_length())
            return $this->validate;

        $this->value = mb_strtolower($this->value);

        $this->validate = Library::is_email($this->value);
        if (!$this->validate && $msg_error != null)
            $this->msg_error = $msg_error;

        return $this->validate;
    }

    /**
     * @param null|string $msg_error
     * @return bool
     */
    public function validate_name($msg_error = null)
    {
        if (!$this->validate_length())
            return $this->validate;

        $this->value = ucfirst($this->value);

        $this->validate = Library::is_name($this->value);
        if (!$this->validate && $msg_error != null)
            $this->msg_error = $msg_error;

        return $this->validate;
    }

    /**
     * @param null|string $msg_error
     * @return bool
     */
    public function validate_phone($msg_error = null)
    {
        if (!$this->validate_length())
            return $this->validate;

        $this->validate = Library::is_phone($this->value);
        if ($this->validate) {
            $this->value = Library::phone($this->value);
        }
        else if ($msg_error != null)
            $this->msg_error = $msg_error;

        return $this->validate;
    }

    /**
     * @param null|string $msg_error
     * @return bool
     */
    public function validate_date($msg_error = null)
    {
        if (!$this->validate_length())
            return $this->validate;

        $this->validate = Library::is_date($this->value);
        if (!$this->validate && $msg_error != null)
            $this->msg_error = $msg_error;

        return $this->validate;
    }

    /**
     * @param null|string $msg_error
     * @return bool
     */
    public function validate_datetime($msg_error = null)
    {
        if (!$this->validate_length())
            return $this->validate;

        $this->validate = Library::is_datetime($this->value);
        if (!$this->validate && $msg_error != null)
            $this->msg_error = $msg_error;

        return $this->validate;
    }

}

/**
 * Class Form
 * @package Deimos
 */
class Form
{

    /**
     * @var array
     */
    private $_data = array();

    /**
     * @var array
     */
    private $_row = array();

    /**
     * @param array $method
     */
    public function __construct($method = array(), $auto_validation = true)
    {
        $this->_data = $method;
        if ($auto_validation) {
            foreach ($this->_data as $name => $value) {
                $this->get($name);

                if (preg_match('/_confirm$/', $name)) {
                    $_name = preg_replace('/_confirm$/', '', $name);
                    if (isset($this->_row[$_name])) {
                        $element = $this->get($_name);
                        $this->get($name)->validate_confirm($element);
                    }
                }
            }
        }
    }

    /**
     * @param $name
     * @return Element_Form
     */
    private function _init_row($name)
    {
        return new Element_Form($name, $this->_data[$name], null);
    }

    /**
     * @return bool
     */
    public function is_validate()
    {
        $valid = true;
        foreach ($this->_row as $name => $row) {
            $valid = $valid && $row->validate;
        }
        return $valid;
    }

    /**
     * @param $name
     * @return null|Element_Form
     */
    public function get($name)
    {
        if (!isset($this->_data[$name]))
            return null;
        if (!isset($this->_row[$name]))
            $this->_row[$name] = $this->_init_row($name);
        return $this->_row[$name];
    }

    public function __get($name)
    {
        return $this->get($name);
    }

}