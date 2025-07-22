<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Source extends AbstractTag
{
    public function __construct(array $attributes = [])
    {
        parent::__construct('source', $attributes);
    }
}
