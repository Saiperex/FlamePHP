<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Embed extends AbstractTag
{
    public function __construct(array $attributes = [])
    {
        parent::__construct('embed', $attributes);
    }
}
