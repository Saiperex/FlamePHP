<?php

namespace App\Views\Shared;namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;
class I extends AbstractTag
{
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('i', $attributes, $children);
    }
}
