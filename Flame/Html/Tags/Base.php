<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Base extends AbstractTag
{
    public function __construct(array $attributes = [])
    {
        parent::__construct('base', $attributes);
    }
}
