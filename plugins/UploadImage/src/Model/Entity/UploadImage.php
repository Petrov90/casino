<?php
namespace UploadImage\Model\Entity;

use Cake\ORM\Entity;

/**
 * UploadImage Entity
 *
 * @property int $id
 * @property string $type
 * @property int $foreign_key
 * @property int $user_id
 * @property string $image
 * @property string $caption
 * @property \Cake\I18n\Time $created
 *
 * @property \App\Model\Entity\User $user
 * @property \CityManager\Model\Entity\City $city
 * @property \CityManager\Model\Entity\Country $country
 * @property \App\Model\Entity\Casino $casino
 */
class UploadImage extends Entity
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
