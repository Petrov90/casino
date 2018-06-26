<?php
namespace Promotion\Model\Entity;

use Cake\ORM\Entity;

/**
 * Promotion Entity.
 *
 * @property int $id
 * @property string $type
 * @property string $title
 * @property string $bonus_amount
 * @property string $description
 * @property string $address
 * @property string $url
 * @property string $email
 * @property string $image
 * @property string $phone
 * @property string $is_feature
 * @property string $slug
 * @property string $software
 * @property int $object_id
 * @property \Promotion\Model\Entity\Object $object
 * @property \Cake\I18n\Time $created
 * @property string $deposit_methods
 * @property string $withdrawal_methods
 * @property string $withdrawal_limit
 * @property string $language
 * @property string $city_name
 * @property int $city_id
 * @property \Promotion\Model\Entity\City $city
 * @property string $currencies
 * @property string $latitude
 * @property string $longitude
 * @property int $review_count
 * @property int $avg_rating
 * @property \Promotion\Model\Entity\PromotionAmenity[] $promotion_amenities
 * @property \Promotion\Model\Entity\PromotionGamblingOption[] $promotion_gambling_options
 */
class Promotion extends Entity
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
