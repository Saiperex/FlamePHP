<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Footer extends AbstractTag
{
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('footer', $attributes, $children);
    }
}
