<?php

declare(strict_types=1);

/**
 * Mageaustralia
 *
 * @package    Mageaustralia_Storefront
 * @copyright  Copyright (c) 2026 Mage Australia Pty Ltd (https://mageaustralia.com.au)
 * @license    AGPL-3.0-only Open source release; commercial licence available. See LICENSE-COMMERCIAL.md.
 */

class Mageaustralia_Storefront_Block_Adminhtml_Dashboard extends Mage_Adminhtml_Block_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('mageaustralia/storefront/dashboard.phtml');
    }
}
