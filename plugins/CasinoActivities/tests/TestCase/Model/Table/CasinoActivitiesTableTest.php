<?php
namespace CasinoActivities\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use CasinoActivities\Model\Table\CasinoActivitiesTable;

/**
 * CasinoActivities\Model\Table\CasinoActivitiesTable Test Case
 */
class CasinoActivitiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \CasinoActivities\Model\Table\CasinoActivitiesTable
     */
    public $CasinoActivities;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.casino_activities.casino_activities',
        'plugin.casino_activities.casino_activitity_datas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CasinoActivities') ? [] : ['className' => 'CasinoActivities\Model\Table\CasinoActivitiesTable'];
        $this->CasinoActivities = TableRegistry::get('CasinoActivities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CasinoActivities);

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
}
