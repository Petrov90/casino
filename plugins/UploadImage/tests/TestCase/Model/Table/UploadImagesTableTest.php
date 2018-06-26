<?php
namespace UploadImage\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use UploadImage\Model\Table\UploadImagesTable;

/**
 * UploadImage\Model\Table\UploadImagesTable Test Case
 */
class UploadImagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \UploadImage\Model\Table\UploadImagesTable
     */
    public $UploadImages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.upload_image.upload_images',
        'plugin.upload_image.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UploadImages') ? [] : ['className' => 'UploadImage\Model\Table\UploadImagesTable'];
        $this->UploadImages = TableRegistry::get('UploadImages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UploadImages);

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
