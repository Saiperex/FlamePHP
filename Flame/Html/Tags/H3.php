<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class H3 extends AbstractTag
{
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('h3', $attributes, $children);
    }
}
