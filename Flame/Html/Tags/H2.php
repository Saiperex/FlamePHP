<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class H2 extends AbstractTag
{
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('h2', $attributes, $children);
    }
}
