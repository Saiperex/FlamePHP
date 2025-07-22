<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Area extends AbstractTag
{
    public function __construct(array $attributes = [])
    {
        parent::__construct('area', $attributes);
    }
}
