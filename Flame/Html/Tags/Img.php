<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class Img extends AbstractTag
{
    public function __construct(array $attributes = [])
    {
        parent::__construct('img', $attributes);
    }
}
