<?php
namespace Custom\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Custom\Model\Table\CustomFieldsTable;

/**
 * Custom\Model\Table\CustomFieldsTable Test Case
 */
class CustomFieldsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Custom\Model\Table\CustomFieldsTable
     */
    public $CustomFields;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.custom.custom_fields',
        'plugin.custom.custom_pages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CustomFields') ? [] : ['className' => 'Custom\Model\Table\CustomFieldsTable'];
        $this->CustomFields = TableRegistry::get('CustomFields', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CustomFields);

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
