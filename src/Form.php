<?php

class Element_Form extends Library
{

    /**
     * @var stdClass
     */
    private $_params;

    /**
     * @var string
     */
    public $expreg = null;

    /**
     * @param $name
     * @param $data
     */
    public function __construct($name, $data)
    {
        $this->_params = new \stdClass();
        $this->_params->value = $data;
        $this->_params->valid = true;

        $this->_params->valid = $this->__get('valid_' . $name);
    }

    /**
     * @return bool
     */
    public function is_expreg()
    {
        $length = mb_strlen($this->_params->value);
        $bool = (bool)preg_match($this->expreg, $this->_params->value, $out);
        $is_one = count($out) == 1;
        $bool = $bool && $is_one;
        if ($bool)
            $bool = $length == mb_strlen($out[0]);
        return $bool;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function __get($method_valid)
    {
        $validator = preg_match('/^valid_/', $method_valid);
        if ($validator) {
            $method_valid = str_replace('valid_', 'is_', $method_valid);
            if (method_exists($this, $method_valid)) {
                $this->_params->valid = $this->$method_valid($this->_params->value);
                if ($this->_params->valid) {
                    $method_valid = str_replace('is_', '', $method_valid);
                    if (method_exists($this, $method_valid)) {
                        $this->_params->value = $this->$method_valid($this->_params->value);
                    }
                }
                $this->_is_error = !$this->_params->valid;
            }
            return $this->_params->valid;
        }
        return $this->_params->$method_valid;
    }

    /**
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
    {
        if ($key == 'value')
            $this->_params->$key = $value;
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
        if ($auto_validation) {
            foreach($this->_data as $row => $testing) {
                $this->$row->valid;
            }
        }
    }

    /**
     * @param $name
     * @return Element_Form
     */
    private function _init_row($name)
    {
        return new Element_Form($name, $this->_data[$name]);
    }

    public function is_valid()
    {
        $valid = true;
        foreach ($this->_row as $row)
            $valid = $valid && $row->valid;
        return $valid;
    }

    /**
     * @param $name
     * @return null|Element_Form
     */
    public function __get($name)
    {
        if (!isset($this->_data[$name]))
            return null;
        if (!isset($this->_row[$name]))
            $this->_row[$name] = $this->_init_row($name);
        return $this->_row[$name];
    }

}