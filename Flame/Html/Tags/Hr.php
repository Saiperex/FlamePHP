<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Hr extends AbstractTag
{
    public function __construct(array $attributes = [])
    {
        parent::__construct('hr', $attributes);
    }
}
