<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Html extends AbstractTag
{
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('html', $attributes, $children);
    }
}
