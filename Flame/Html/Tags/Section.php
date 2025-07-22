<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Section extends AbstractTag
{
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('section', $attributes, $children);
    }
}
