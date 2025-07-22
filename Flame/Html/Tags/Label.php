<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Label extends AbstractTag
{
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('label', $attributes, $children);
    }
}
