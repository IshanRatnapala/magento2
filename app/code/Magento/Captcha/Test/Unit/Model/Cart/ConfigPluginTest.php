<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Captcha\Test\Unit\Model\Cart;

class ConfigPluginTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\Captcha\Model\Cart\ConfigPlugin
     */
    protected $model;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $configProviderMock;

    protected function setUp()
    {
        $this->configProviderMock = $this->getMock(
            \Magento\Captcha\Model\Checkout\ConfigProvider::class,
            [],
            [],
            '',
            false
        );
        $this->model = new \Magento\Captcha\Model\Cart\ConfigPlugin(
            $this->configProviderMock
        );
    }

    public function testAfterGetConfig()
    {
        $resultMock = [
            'result' => [
                'data' => 'resultDataMock'
            ]
        ];
        $configMock = [
            'config' => [
                'data' => 'configDataMock'
            ]
        ];
        $expectedResult = array_merge_recursive($resultMock, $configMock);
        $sidebarMock = $this->getMock(\Magento\Checkout\Block\Cart\Sidebar::class, [], [], '', false);
        $this->configProviderMock->expects($this->once())->method('getConfig')->willReturn($configMock);

        $this->assertEquals($expectedResult, $this->model->afterGetConfig($sidebarMock, $resultMock));
    }
}
