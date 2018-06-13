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

namespace Experius\LogManager\Model\Config\Source;

class Level implements \Magento\Framework\Option\ArrayInterface
{

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];
        foreach ($this->toArray() as $value => $label) {
            $options[] =['value' => $value, 'label' => $label];
        }
        return $options;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'emergency' => __('emergency'),
            'alert' => __('alert'),
            'critical' => __('critical'),
            'error' => __('error'),
            'warning' => __('warning'),
            'notice' => __('notice'),
            'info' => __('info'),
            'debug' => __('debug')
        ];
    }
}
