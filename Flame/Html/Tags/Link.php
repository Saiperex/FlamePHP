<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Link extends AbstractTag
{
    public function __construct(array $attributes = [])
    {
        parent::__construct('link', $attributes);
    }
}
