<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Div extends AbstractTag
{
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('div', $attributes, $children);
    }
}
