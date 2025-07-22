<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Ul extends AbstractTag
{
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('ul', $attributes, $children);
    }
}
