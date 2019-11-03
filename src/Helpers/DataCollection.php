<?php
namespace App\Helpers;

class DataCollection {

    public $items;
    public $total;
    public $page;
    
    public function __construct($items, $total, $page)
    {
        $this->items = $items;
        $this->total = $total;
        $this->page = $page;
    }
}