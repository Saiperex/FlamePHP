<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Body extends AbstractTag
{
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('body', $attributes, $children);
    }
}
