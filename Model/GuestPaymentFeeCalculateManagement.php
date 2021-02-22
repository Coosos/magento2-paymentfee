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

namespace Mageprince\Paymentfee\Model;

use Magento\Quote\Model\QuoteIdMaskFactory;
use Mageprince\Paymentfee\Api\GuestPaymentFeeCalculateManagementInterface;
use Mageprince\Paymentfee\Api\PaymentFeeCalculateManagementInterface;

/**
 * Guest payment fee calculate management
 *
 * @package   Mageprince\Paymentfee
 * @author    MagePrince <info@mageprince.com>
 * @copyright Copyright (c) 2021 Mageprince (http://www.mageprince.com/)
 */
class GuestPaymentFeeCalculateManagement implements GuestPaymentFeeCalculateManagementInterface
{
    /**
     * @var QuoteIdMaskFactory
     */
    private $quoteIdMaskFactory;

    /**
     * @var PaymentFeeCalculateManagementInterface
     */
    private $paymentFeeCalculateManagement;

    /**
     * GuestPaymentFeeCalculateManagement constructor.
     *
     * @param QuoteIdMaskFactory                     $quoteIdMaskFactory            Quote id mask factory
     * @param PaymentFeeCalculateManagementInterface $paymentFeeCalculateManagement Payment fee calculate management
     */
    public function __construct(
        QuoteIdMaskFactory $quoteIdMaskFactory,
        PaymentFeeCalculateManagementInterface $paymentFeeCalculateManagement
    ) {
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
        $this->paymentFeeCalculateManagement = $paymentFeeCalculateManagement;
    }

    /**
     * Calculate
     *
     * @param int $cartId           Cart id
     * @param string $paymentMethod Payment method
     *
     * @return array
     */
    public function calculate($cartId, $paymentMethod)
    {
        $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');

        return $this->paymentFeeCalculateManagement->calculate($quoteIdMask->getQuoteId(), $paymentMethod);
    }
}
