<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

// @codingStandardsIgnoreFile

namespace Magento\Multishipping\Test\Unit\Block\Checkout\Payment;

use Magento\Multishipping\Block\Checkout\Payment\Info;

class InfoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Info
     */
    protected $model;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $multiShippingMock;

    protected function setUp()
    {
        $this->multiShippingMock =
            $this->getMock(\Magento\Multishipping\Model\Checkout\Type\Multishipping::class, [], [], '', false);
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $this->model = $objectManager->getObject(
            \Magento\Multishipping\Block\Checkout\Payment\Info::class,
            [
                'multishipping' => $this->multiShippingMock,
            ]
        );
    }

    public function testGetPaymentInfo()
    {
        $quoteMock = $this->getMock(\Magento\Quote\Model\Quote::class, [], [], '', false);
        $paymentInfoMock = $this->getMock(\Magento\Payment\Model\Info::class, [], [], '', false);
        $this->multiShippingMock->expects($this->once())->method('getQuote')->willReturn($quoteMock);
        $quoteMock->expects($this->once())->method('getPayment')->willReturn($paymentInfoMock);

        $this->model->getPaymentInfo();
    }
}
