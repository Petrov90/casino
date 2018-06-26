<?php
namespace Promotion\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Promotion\Model\Table\PromotionAmenitiesTable;

/**
 * Promotion\Model\Table\PromotionAmenitiesTable Test Case
 */
class PromotionAmenitiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Promotion\Model\Table\PromotionAmenitiesTable
     */
    public $PromotionAmenities;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.promotion.promotion_amenities',
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
        $config = TableRegistry::exists('PromotionAmenities') ? [] : ['className' => 'Promotion\Model\Table\PromotionAmenitiesTable'];
        $this->PromotionAmenities = TableRegistry::get('PromotionAmenities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PromotionAmenities);

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
