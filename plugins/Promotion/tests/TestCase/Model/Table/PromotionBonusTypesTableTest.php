<?php
namespace Promotion\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Promotion\Model\Table\PromotionBonusTypesTable;

/**
 * Promotion\Model\Table\PromotionBonusTypesTable Test Case
 */
class PromotionBonusTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Promotion\Model\Table\PromotionBonusTypesTable
     */
    public $PromotionBonusTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.promotion.promotion_bonus_types',
        'plugin.promotion.promotions',
        'plugin.promotion.casino',
        'plugin.promotion.casino_amenities',
        'plugin.promotion.casinos',
        'plugin.promotion.casino_gambling_options',
        'plugin.promotion.masters',
        'plugin.promotion.parent_masters',
        'plugin.promotion.child_masters',
        'plugin.promotion.masters_name_translation',
        'plugin.promotion.i18n',
        'plugin.promotion.casino_gambling_options_name_translation',
        'plugin.promotion.city',
        'plugin.promotion.country',
        'plugin.promotion.reviews',
        'plugin.promotion.users',
        'plugin.promotion.review_likes',
        'plugin.promotion.review_comments',
        'plugin.promotion.country_name_translation',
        'plugin.promotion.country_description_translation',
        'plugin.promotion.city_name_translation',
        'plugin.promotion.city_description_translation',
        'plugin.promotion.single_review',
        'plugin.promotion.casino_amenities_name_translation'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PromotionBonusTypes') ? [] : ['className' => 'Promotion\Model\Table\PromotionBonusTypesTable'];
        $this->PromotionBonusTypes = TableRegistry::get('PromotionBonusTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PromotionBonusTypes);

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
