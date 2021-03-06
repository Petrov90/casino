<?php
namespace Promotion\Model\Entity;

use Cake\ORM\Entity;

/**
 * PromotionBonusType Entity.
 *
 * @property int $id
 * @property int $promotion_id
 * @property \Promotion\Model\Entity\Promotion $promotion
 * @property int $master_id
 * @property \Promotion\Model\Entity\Master $master
 * @property int $value
 */
class PromotionBonusType extends Entity
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
