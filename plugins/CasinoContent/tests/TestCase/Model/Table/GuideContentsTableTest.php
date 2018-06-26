<?php
namespace GuideContent\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use GuideContent\Model\Table\GuideContentsTable;

/**
 * GuideContent\Model\Table\GuideContentsTable Test Case
 */
class GuideContentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \GuideContent\Model\Table\GuideContentsTable
     */
    public $GuideContents;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.guide_content.guide_contents'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('GuideContents') ? [] : ['className' => 'GuideContent\Model\Table\GuideContentsTable'];
        $this->GuideContents = TableRegistry::get('GuideContents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GuideContents);

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
