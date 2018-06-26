<?php
namespace CasinoActivities\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use CasinoActivities\Model\Table\CasinoActivityDatasTable;

/**
 * CasinoActivities\Model\Table\CasinoActivityDatasTable Test Case
 */
class CasinoActivityDatasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \CasinoActivities\Model\Table\CasinoActivityDatasTable
     */
    public $CasinoActivityDatas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.casino_activities.casino_activity_datas',
        'plugin.casino_activities.casinos',
        'plugin.casino_activities.casino_activities'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CasinoActivityDatas') ? [] : ['className' => 'CasinoActivities\Model\Table\CasinoActivityDatasTable'];
        $this->CasinoActivityDatas = TableRegistry::get('CasinoActivityDatas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CasinoActivityDatas);

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
