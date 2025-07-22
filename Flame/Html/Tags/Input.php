<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Input extends AbstractTag
{
    public function __construct(array $attributes = [])
    {
        parent::__construct('input', $attributes);
    }
}
