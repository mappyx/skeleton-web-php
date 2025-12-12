<?php

namespace System;

class Validator
{
    private $errors = [];

    public function validate(array $data, array $rules): bool
    {
        foreach ($rules as $field => $fieldRules) {
            $value = $data[$field] ?? null;
            $ruleList = explode('|', $fieldRules);

            foreach ($ruleList as $rule) {
                if ($rule === 'required' && empty($value)) {
                    $this->addError($field, "The $field field is required.");
                    continue;
                }

                if (!empty($value)) {
                    if ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $this->addError($field, "The $field must be a valid email.");
                    }

                    if ($rule === 'numeric' && !is_numeric($value)) {
                        $this->addError($field, "The $field must be numeric.");
                    }
                    
                    if (strpos($rule, 'min:') === 0) {
                        $min = substr($rule, 4);
                        if (strlen($value) < $min) {
                            $this->addError($field, "The $field must be at least $min characters.");
                        }
                    }

                    if (strpos($rule, 'max:') === 0) {
                        $max = substr($rule, 4);
                        if (strlen($value) > $max) {
                            $this->addError($field, "The $field must not exceed $max characters.");
                        }
                    }
                }
            }
        }

        return empty($this->errors);
    }

    private function addError($field, $message)
    {
        $this->errors[$field][] = $message;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
