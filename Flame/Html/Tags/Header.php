<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Header extends AbstractTag
{
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('header', $attributes, $children);
    }
}
