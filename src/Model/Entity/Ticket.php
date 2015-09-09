<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ticket Entity.
 */
class Ticket extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => true,
        'content' => true,
        'subjects' => true
    ];
}
