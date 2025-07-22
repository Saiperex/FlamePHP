<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class H5 extends AbstractTag
{
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('h5', $attributes, $children);
    }
}
