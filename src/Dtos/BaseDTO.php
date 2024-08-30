<?php

namespace Hernanaguilera\PruebaTecnicaPhp\Dtos;


abstract class BaseDTO
{
    protected $fields;

    public function __construct()
    {
        $this->fields = [];
    }

    public function setField($name, $value)
    {
        $this->fields[$name] = $value;
    }

    public function setFields($fields)
    {
        $this->fields = array_merge($this->fields, $fields);
    }

    public function getField($name)
    {
        return $this->fields[$name] ?? null;
    }

    public function getFields(array $fields)
    {
        $result = [];
        foreach ($fields as $field) {
            $result[$field] = $this->fields[$field];
        }
        return $result;
    }

    public function getAllFields()
    {
        return $this->fields;
    }

    public function hasField($name)
    {
        return isset($this->fields[$name]);
    }

    public function removeField($name)
    {
        unset($this->fields[$name]);
    }

    public function clearFields()
    {
        $this->fields = [];
    }
}
