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

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Api\CartRepositoryInterface;
use Mageprince\Paymentfee\Api\PaymentFeeCalculateManagementInterface;

/**
 * Payment fee calculate management
 *
 * @package   Mageprince\Paymentfee
 * @author    MagePrince <info@mageprince.com>
 * @copyright Copyright (c) 2021 Mageprince (http://www.mageprince.com/)
 */
class PaymentFeeCalculateManagement implements PaymentFeeCalculateManagementInterface
{
    /**
     * @var CartRepositoryInterface
     */
    private $quoteRepository;

    /**
     * PaymentFeeCalculateManagement constructor.
     *
     * @param CartRepositoryInterface $quoteRepository Quote repository
     */
    public function __construct(CartRepositoryInterface $quoteRepository)
    {
        $this->quoteRepository = $quoteRepository;
    }

    /**
     * Calculate
     *
     * @param int $cartId           Cart id
     * @param string $paymentMethod Payment method
     *
     * @return array
     * @throws NoSuchEntityException
     */
    public function calculate($cartId, $paymentMethod)
    {
        $quote = $this->quoteRepository->getActive($cartId);
        $quote->getPayment()->setMethod($paymentMethod);
        $this->quoteRepository->save($quote->collectTotals());

        return [];
    }
}
