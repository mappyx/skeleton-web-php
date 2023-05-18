<?php

namespace System;

class View
{
    protected $template;
    
    public function __construct(string $template)
    {
        $this->template = $template;
    }

    public function render(array $data = [])
    {
        extract($data);
        include $this->template;
    }
}