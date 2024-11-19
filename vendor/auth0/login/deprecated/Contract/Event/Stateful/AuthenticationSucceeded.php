<?php

declare(strict_types=1);

namespace Auth0\Laravel\Contract\Event\Stateful;

use Auth0\Laravel\Events\AuthenticationSucceededContract;

/**
 * @deprecated 7.8.0 Use Auth0\Laravel\Events\AuthenticationSucceeded instead.
 *
 * @api
 */
interface AuthenticationSucceeded extends AuthenticationSucceededContract
{
}
