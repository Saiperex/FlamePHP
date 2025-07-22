<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Br extends AbstractTag
{
    public function __construct(array $attributes = [])
    {
        parent::__construct('br', $attributes);
    }
}
