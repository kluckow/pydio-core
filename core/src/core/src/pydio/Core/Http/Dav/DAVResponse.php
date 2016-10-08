<?php
/*
 * Copyright 2007-2016 Abstrium <contact (at) pydio.com>
 * This file is part of Pydio.
 *
 * Pydio is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Pydio is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with Pydio.  If not, see <http://www.gnu.org/licenses/>.
 *
 * The latest code can be found at <https://pydio.com/>.
 */
namespace Pydio\Core\Http\Dav;

use Pydio\Core\Controller\ShutdownScheduler;
use Sabre\HTTP\Response;

defined('AJXP_EXEC') or die('Access not allowed');

/**
 * Class DAVResponse
 * Make sure to close connection and apply ShutdownScheduler afterward
 * @package Pydio\Core\Http\Dav
 */
class DAVResponse extends Response
{
    /**
     * Override parent function
     * @param mixed $body
     */
    public function sendBody($body)
    {
        ShutdownScheduler::setCloseHeaders($this);
        parent::sendBody($body);
        ShutdownScheduler::getInstance()->callRegisteredShutdown();
    }
}