<?php

declare(strict_types=1);

/**
 * Mageaustralia
 *
 * @package    Mageaustralia_Storefront
 * @copyright  Copyright (c) 2026 Mage Australia Pty Ltd (https://mageaustralia.com.au)
 * @license    AGPL-3.0-only Open source release; commercial licence available. See LICENSE-COMMERCIAL.md.
 */

class Mageaustralia_Storefront_Model_Log extends Mage_Core_Model_Abstract
{
    #[\Override]
    protected function _construct(): void
    {
        $this->_init('mageaustralia_storefront/log');
    }
}
