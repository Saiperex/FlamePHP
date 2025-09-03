<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class legend extends AbstractTag
{
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('legend', $attributes, $children);
    }
}
