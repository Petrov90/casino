<?php
namespace Custom\Model\Entity;

use Cake\ORM\Entity;

/**
 * CustomPage Entity
 *
 * @property int $id
 * @property string $slug
 *
 * @property \Custom\Model\Entity\CustomField[] $custom_fields
 */
class CustomPage extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
