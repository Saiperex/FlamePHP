<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Track extends AbstractTag
{
    public function __construct(array $attributes = [])
    {
        parent::__construct('track', $attributes);
    }
}
