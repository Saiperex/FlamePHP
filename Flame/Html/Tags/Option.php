<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Option extends AbstractTag
{
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('option', $attributes, $children);
    }
}
