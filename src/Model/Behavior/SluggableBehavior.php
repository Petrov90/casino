<?php
namespace App\Model\Behavior;

use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\Utility\Inflector;

class SluggableBehavior extends Behavior
{
    protected $_defaultConfig = [
        'field' => 'title',
        'slug' => 'slug',
        'replacement' => '-',
    ];

    public function slug(Entity $entity)
    {
        $config = 	$this->config();
        $value 	= 	$entity->get($config['field']);
		
		$slug	=	$this->slugify($value);
		
		$entity->set($config['slug'], $slug);
    }

    public function beforeSave(Event $event, EntityInterface $entity)
    {
        $this->slug($entity);
    }
	
	/**
     * Return a slugged version of a string.
     *
     * @param Model $model
     * @param string $string
     * @return string
     */
    public function slugify($string) {
        $string = strip_tags($string);
        $string = str_replace('&amp;', 'and', $string);
        $string = str_replace('&', 'and', $string);
        $string = str_replace('@', 'at', $string);

        return mb_strtolower(Inflector::slug($string, $this->_defaultConfig['replacement']));
    }	
}
