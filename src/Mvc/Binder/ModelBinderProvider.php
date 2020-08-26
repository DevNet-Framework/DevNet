<?php declare(strict_types = 1);
/**
 * @author      Mohammed Moussaoui
 * @copyright   Copyright (c) Mohammed Moussaoui. All rights reserved.
 * @license     MIT License. For full license information see LICENSE file in the project root.
 * @link        https://github.com/artister
 */

namespace Artister\DevNet\Mvc\Binder;

use IteratorAggregate;
use ArrayIterator;

class ModelBinderProvider implements IteratorAggregate
{
    private array $ModelBinders = [];

    public function __construct(IModelBinder $modelBinder = null)
    {
        if ($modelBinder)
        {
            $this->ModelBinders[] = $modelBinder;
        }
    }

    public function add(IModelBinder $modelBinder)
    {
        $this->ModelBinders[] = $modelBinder;
        return $this;
    }

    public function getIterator() : iterable
    {
        return new ArrayIterator($this->ModelBinders);
    }
}