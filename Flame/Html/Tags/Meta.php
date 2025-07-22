<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Meta extends AbstractTag
{
    public function __construct(array $attributes = [])
    {
        parent::__construct('meta', $attributes);
    }
}
