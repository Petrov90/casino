<?php
namespace Promotion\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Promotion\Model\Table\PopularCasinosTable;

/**
 * Promotion\Model\Table\PopularCasinosTable Test Case
 */
class PopularCasinosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Promotion\Model\Table\PopularCasinosTable
     */
    public $PopularCasinos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.promotion.popular_casinos',
        'plugin.promotion.casinos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PopularCasinos') ? [] : ['className' => 'Promotion\Model\Table\PopularCasinosTable'];
        $this->PopularCasinos = TableRegistry::get('PopularCasinos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PopularCasinos);

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
