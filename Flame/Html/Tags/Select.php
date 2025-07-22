<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Select extends AbstractTag
{
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('select', $attributes, $children);
    }
}
