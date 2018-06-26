<?php
namespace CasinoActivities\Model\Entity;

use Cake\ORM\Entity;

/**
 * CasinoActivity Entity
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $phone
 * @property string $coach
 * @property string $schedule
 *
 * @property \CasinoActivities\Model\Entity\CasinoActivitityData[] $casino_activitity_datas
 */
class CasinoActivity extends Entity
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
