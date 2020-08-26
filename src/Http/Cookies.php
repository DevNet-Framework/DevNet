<?php declare(strict_types = 1);
/**
 * @author      Mohammed Moussaoui
 * @copyright   Copyright (c) Mohammed Moussaoui. All rights reserved.
 * @license     MIT License. For full license information see LICENSE file in the project root.
 * @link        https://github.com/artister
 */

namespace Artister\DevNet\Http;

use Artister\System\Collections\Enumerator;
use Artister\System\Collections\IDictionary;
use DateTime;

class Cookies
{
    public array $Cookies = [];
    public Headers $Headers;

    public function __construct(Headers $headers)
    {
        $this->Headers = $headers;

        if ($headers->contains('cookie'))
        {
            $cookieString = $headers->getValues('cookie')[0];
            $cookieString = str_replace(' ', '', $cookieString);
            $cookieString = rtrim($cookieString, ';');
            $cookieFragments = explode(';', $cookieString);

            foreach ($cookieFragments as $fragement)
            {
                $cookie = explode('=', $fragement);
                if (isset($cookie[1]))
                {
                    $this->Cookies[$cookie[0]] = $cookie[1];
                }
            }
        }
    }

    public function add(String $name, string $value, DateTime $expires)
    {
        $this->Cookies[$name] = $value;

        $expires = $expires->format(DateTime::COOKIE);
        $value = "{$name}={$value}; expires={$expires};";
        $this->Headers->add('Set-Cookie', $value);
    }

    public function contains(string $name) : bool
    {
        return isset($this->Cookies[$name]);
    }

    public function remove(String $name)
    {
        if ($this->contains($name))
        {
            $this->Headers->remove($name);
            unset($this->Cookies[$name]);
        }
    }

    public function getIterator() : iterable
    {
        return new Enumerator($this->Cookies);
    }
}
