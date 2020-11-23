<?php

/**
 * MagePrince
 * Copyright (C) 2020 Mageprince <info@mageprince.com>
 *
 * @package Mageprince_Paymentfee
 * @copyright Copyright (c) 2020 Mageprince (http://www.mageprince.com/)
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author MagePrince <info@mageprince.com>
 */

namespace Mageprince\Paymentfee\Block\Sales\Order\Creditmemo;

use Magento\Framework\DataObject;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Sales\Model\Order\Creditmemo;
use Mageprince\Paymentfee\Helper\Data;

class Totals extends Template
{
    /**
     * @var Creditmemo
     */
    protected $_creditmemo = null;

    /**
     * @var DataObject
     */
    protected $_source;

    /**
     * @var Data
     */
    protected $helper;

    /**
     * @param Context $context
     * @param Data $helper
     * @param array $data
     */
    public function __construct(
        Context $context,
        Data $helper,
        array $data = []
    ) {
        $this->helper = $helper;
        parent::__construct($context, $data);
    }

    /**
     * @return DataObject
     */
    public function getSource()
    {
        return $this->getParentBlock()->getSource();
    }

    public function getCreditmemo()
    {
        return $this->getParentBlock()->getCreditmemo();
    }

    /**
     * @return $this
     */
    public function initTotals()
    {
        $parent = $this->getParentBlock();

        $this->order = $parent->getOrder();
        $this->source = $parent->getSource();

        $feeAmount = $this->order->getPaymentFee();
        $baseFeeAmount = $this->order->getBasePaymentFee();

        if ($feeAmount > 0) {
            $feeTitle = $this->helper->getTitle($this->source->getStoreId());
            $fee = new \Magento\Framework\DataObject(
                [
                    'code' => 'payment_fee',
                    'strong' => false,
                    'value' => $feeAmount,
                    'base_value' => $baseFeeAmount,
                    'label' => $feeTitle,
                ]
            );
            $parent->addTotalBefore($fee, 'grand_total');
        }

        return $this;
    }
}
