<?php

namespace App\Filters;

class TicketTypeFilter extends QueryFilter
{
    protected $filterable = [
        'id',
        'post_vat_price',
        'pre_vat_price',
        'vat',
        'pattern',
        'serial',
        'is_actived',
        'duration',
        'expired',
    ];
    
    public function filterTitle($title)
    {
        return $this->builder->where('title', 'like', '%' . $title . '%');
    }
    
    public function filterName($name)
    {
        return $this->builder->where('name', 'like', '%' . $name . '%');
    }
}

