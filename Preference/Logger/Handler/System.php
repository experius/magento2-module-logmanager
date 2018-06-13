<?php
/**
 * A Magento 2 module named Experius/LogManager
 * Copyright (C) 2018 Maikel Martens
 *
 * This file is part of Experius/LogManager.
 *
 * Experius/LogManager is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Experius\LogManager\Preference\Logger\Handler;

use Magento\Framework\Filesystem\DriverInterface;
use Magento\Framework\Logger\Handler\Exception;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Monolog\Logger;

class System extends \Magento\Framework\Logger\Handler\System
{
    /** @var ScopeConfigInterface */
    protected $scopeConfig;

    /**
     * @param DriverInterface $filesystem
     * @param Exception $exceptionHandler
     * @param ScopeConfigInterface $scopeConfig
     * @param string|null $filePath
     */
    public function __construct(
        DriverInterface $filesystem,
        Exception $exceptionHandler,
        ScopeConfigInterface $scopeConfig,
        string $filePath = null
    ) {
        parent::__construct($filesystem, $exceptionHandler, $filePath);
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function isHandling(array $record)
    {

        if (!$this->scopeConfig->getValue('log_manager/system/enabled', ScopeInterface::SCOPE_STORE)) {
            return false;
        }

        $level = [
            'emergency' => Logger::EMERGENCY,
            'alert' => Logger::ALERT,
            'critical' => Logger::CRITICAL,
            'error' => Logger::ERROR,
            'warning' => Logger::WARNING,
            'notice' => Logger::NOTICE,
            'info' => Logger::INFO,
            'debug' => Logger::DEBUG,
        ][$this->scopeConfig->getValue('log_manager/system/level', ScopeInterface::SCOPE_STORE)] ?? Logger::INFO;

        return $record['level'] >= $level;
    }
}
