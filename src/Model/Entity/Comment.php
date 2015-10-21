<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Comment extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => true,
        'user_id' => true,
        'ticket_id' => true,
        'content'   => true,
        'is_spam'   => true
    ];
}
