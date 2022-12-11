<?php

namespace App\Helpers;
use Request;

class Counter
{
    private $count;
    function __construct($default=20)
    {
        if (!empty(Request::input("page")))
        {
            if (!empty(Request::input("per_page")))
            {
                $default = Request::input("per_page");
            }
            $this->count = (Request::input("page")-1)*$default;
        }
        else
        {
            $this->count = 0;
        }
    }

    public function plus()
    {
        $this->count++;
        return $this->count;
    }
}