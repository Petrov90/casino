<?php
namespace Custom\Model\Entity;

use Cake\ORM\Entity;

/**
 * CustomField Entity
 *
 * @property int $id
 * @property string $field_name
 * @property string $field_value
 * @property string $type
 * @property int $custom_page_id
 *
 * @property \Custom\Model\Entity\CustomPage $custom_page
 */
class CustomField extends Entity
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
