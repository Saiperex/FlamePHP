<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Span extends AbstractTag
{
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('span', $attributes, $children);
    }
}
