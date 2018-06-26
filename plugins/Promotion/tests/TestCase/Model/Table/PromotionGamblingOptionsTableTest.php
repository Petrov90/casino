<?php
namespace Promotion\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Promotion\Model\Table\PromotionGamblingOptionsTable;

/**
 * Promotion\Model\Table\PromotionGamblingOptionsTable Test Case
 */
class PromotionGamblingOptionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Promotion\Model\Table\PromotionGamblingOptionsTable
     */
    public $PromotionGamblingOptions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.promotion.promotion_gambling_options',
        'plugin.promotion.promotions',
        'plugin.promotion.masters'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PromotionGamblingOptions') ? [] : ['className' => 'Promotion\Model\Table\PromotionGamblingOptionsTable'];
        $this->PromotionGamblingOptions = TableRegistry::get('PromotionGamblingOptions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PromotionGamblingOptions);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
