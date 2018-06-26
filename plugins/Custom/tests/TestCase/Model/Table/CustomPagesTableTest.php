<?php
namespace Custom\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Custom\Model\Table\CustomPagesTable;

/**
 * Custom\Model\Table\CustomPagesTable Test Case
 */
class CustomPagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Custom\Model\Table\CustomPagesTable
     */
    public $CustomPages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.custom.custom_pages',
        'plugin.custom.custom_fields'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CustomPages') ? [] : ['className' => 'Custom\Model\Table\CustomPagesTable'];
        $this->CustomPages = TableRegistry::get('CustomPages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CustomPages);

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
