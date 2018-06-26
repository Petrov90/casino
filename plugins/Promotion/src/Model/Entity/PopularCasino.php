<?php
namespace Promotion\Model\Entity;

use Cake\ORM\Entity;

/**
 * PopularCasino Entity
 *
 * @property int $id
 * @property int $casino_id
 * @property string $text
 * @property string $image
 * @property string $url
 *
 * @property \Promotion\Model\Entity\Casino $casino
 */
class PopularCasino extends Entity
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
