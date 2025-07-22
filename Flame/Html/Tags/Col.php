<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Col extends AbstractTag
{
    public function __construct(array $attributes = [])
    {
        parent::__construct('col', $attributes);
    }
}
