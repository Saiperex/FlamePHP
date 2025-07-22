<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class H4 extends AbstractTag
{
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('h4', $attributes, $children);
    }
}
