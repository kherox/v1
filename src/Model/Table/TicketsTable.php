<?php
namespace App\Model\Table;

use App\Model\Entity\Ticket;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TicketsTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('tickets');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Comments', [
            'className' => 'Comments',
            'foreignKey' => 'ticket_id'
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'ticket_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'tickets_tags'
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');


        $validator
            ->requirePresence('subjects', 'create')
            ->add('subjects', [
                'length' => [
                    'rule' => ['minLength', 5],
                    'message' => 'Votre sujet doit contenir au moins 5 caractères',
                ]
            ])
            ->notEmpty('subjects');

        $validator
            ->requirePresence('content', 'create')
            ->add('content', [
                'length' => [
                    'rule' => ['minLength', 10],
                    'message' => 'Votre contenu doit contenir au moins 5 caractères',
                ]
            ])
            ->notEmpty('content');

        $validator
            ->add('comment_count', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('comment_count');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }
}
