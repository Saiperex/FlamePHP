<?php
namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;

class A extends AbstractTag
{
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct('a', $attributes, $children);
    }
}
