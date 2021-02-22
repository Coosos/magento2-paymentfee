<?php

/**
 * MagePrince
 * Copyright (C) 2021 Mageprince <info@mageprince.com>
 *
 * @package   Mageprince\Paymentfee
 * @copyright Copyright (c) 2021 Mageprince (http://www.mageprince.com/)
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author    MagePrince <info@mageprince.com>
 */

namespace Mageprince\Paymentfee\Api;

/**
 * Payment fee calculate management interface
 *
 * @package   Mageprince\Paymentfee
 * @author    MagePrince <info@mageprince.com>
 * @copyright Copyright (c) 2021 Mageprince (http://www.mageprince.com/)
 */
interface PaymentFeeCalculateManagementInterface
{
    /**
     * Calculate
     *
     * @param int $cartId           Cart id
     * @param string $paymentMethod Payment method
     *
     * @return array
     */
    public function calculate($cartId, $paymentMethod);
}
