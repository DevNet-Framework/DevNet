<?php declare(strict_types = 1);
/**
 * @author      Mohammed Moussaoui
 * @copyright   Copyright (c) Mohammed Moussaoui. All rights reserved.
 * @license     MIT License. For full license information see LICENSE file in the project root.
 * @link        https://github.com/artister
 */

namespace Artister\DevNet\Http;

abstract class HttpMessage
{
    protected string $Protocol;
    protected Headers $Headers;
    protected Cookies $Cookies;
    protected $Body;

    public function setProtocol(string $protocol = null)
    {
        if (!$protocol)
        {
            $protocol = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : '';
        }

        $this->Protocol = $protocol;
    }

    abstract public function __get(string $name);
}
