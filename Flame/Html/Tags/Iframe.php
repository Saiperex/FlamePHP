<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Iframe extends AbstractTag
{
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('iframe', $attributes, $children);
    }
}
