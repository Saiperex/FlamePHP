<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Form extends AbstractTag
{
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('form', $attributes, $children);
    }
}
