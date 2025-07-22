<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Script extends AbstractTag
{
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('script', $attributes, $children);
    }
}
