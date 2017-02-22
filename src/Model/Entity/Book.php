<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Book Entity
 *
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property string $slug
 * @property string $image
 * @property string $info
 * @property int $price
 * @property int $sale_price
 * @property int $pages
 * @property string $publisher
 * @property \Cake\I18n\Time $publish_date
 * @property string $link_download
 * @property bool $published
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Comment[] $comments
 * @property \App\Model\Entity\Writer[] $writers
 */
class Book extends Entity
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
    public function latest(){
        return $this->Book->find('all',array(
            'fields' => array('id','title','image','sale_price','slug'),
            'order'=> array('created'=>'desc'),
            'limit'=> 10,
            'conditions' => array('published'=>1),
            'contain' => array('Writer'=>array(
                'fields' => array('name','slug')
                ))
            ));
    }
}
