<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class TextArea extends AbstractTag
{
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('textarea', $attributes, $children);
    }
}
