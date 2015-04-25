<?php

class Element_Form extends Library
{

    /**
     * @var bool
     */
    public $validate = true;

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

    public function validate_numberic()
    {
        return $this->validate_number();
    }

    public function validate_number()
    {
        $this->validate = is_numeric($this->value);
        return $this->validate;
    }

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

    public function validate_email($msg_error = null)
    {
        if (!$this->validate_length())
            return $this->validate;

        $this->validate = parent::is_email($this->value);
        if (!$this->validate && $msg_error != null)
            $this->msg_error = $msg_error;

        return $this->validate;
    }

    public function validate_name($msg_error = null)
    {
        if (!$this->validate_length())
            return $this->validate;

        $this->validate = parent::is_name($this->value);
        if (!$this->validate && $msg_error != null)
            $this->msg_error = $msg_error;

        return $this->validate;
    }

    public function validate_phone($msg_error = null)
    {
        if (!$this->validate_length())
            return $this->validate;

        $this->value = parent::phone($this->value);
        $this->validate = parent::is_phone($this->value);
        if (!$this->validate && $msg_error != null)
            $this->msg_error = $msg_error;

        return $this->validate;
    }

    public function validate_date($msg_error = null)
    {
        if (!$this->validate_length())
            return $this->validate;

        $this->validate = parent::is_date($this->value);
        if (!$this->validate && $msg_error != null)
            $this->msg_error = $msg_error;

        return $this->validate;
    }

    public function validate_datetime($msg_error = null)
    {
        if (!$this->validate_length())
            return $this->validate;

        $this->validate = parent::is_datetime($this->value);
        if (!$this->validate && $msg_error != null)
            $this->msg_error = $msg_error;

        return $this->validate;
    }

}

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
        if ($auto_validation)
            foreach($this->_data as $name => $value)
                $this->get($name);
    }

    /**
     * @param $name
     * @return Element_Form
     */
    private function _init_row($name)
    {
        return new Element_Form($name, $this->_data[$name], null);
    }

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