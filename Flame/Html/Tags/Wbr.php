<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Wbr extends AbstractTag
{
    public function __construct(array $attributes = [])
    {
        parent::__construct('wbr', $attributes);
    }
}
