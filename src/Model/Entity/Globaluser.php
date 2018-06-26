<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Casino Entity.
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $aaddres
 * @property string $url
 * @property string $email
 * @property string $image
 * @property int $created
 */
class Globaluser extends Entity
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
        'id' => false,
    ];
}
