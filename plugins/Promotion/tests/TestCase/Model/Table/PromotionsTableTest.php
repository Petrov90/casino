<?php
namespace Promotion\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Promotion\Model\Table\PromotionsTable;

/**
 * Promotion\Model\Table\PromotionsTable Test Case
 */
class PromotionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Promotion\Model\Table\PromotionsTable
     */
    public $Promotions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.promotion.promotions',
        'plugin.promotion.objects',
        'plugin.promotion.cities',
        'plugin.promotion.promotion_amenities',
        'plugin.promotion.promotion_gambling_options'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Promotions') ? [] : ['className' => 'Promotion\Model\Table\PromotionsTable'];
        $this->Promotions = TableRegistry::get('Promotions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Promotions);

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
