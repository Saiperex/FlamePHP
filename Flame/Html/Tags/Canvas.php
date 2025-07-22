<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Canvas extends AbstractTag
{
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('canvas', $attributes, $children);
    }
}
