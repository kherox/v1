<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('users');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->hasMany('Tickets', [
            'foreignKey' => 'user_id'
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('username', 'create')
            ->notEmpty('username')
            ->add('username', [
                'length' => [
                    'rule' => ['maxLength', 5],
                    'message' => 'Votre username doit avoir moins que 5 caractères',
                ]
            ]);

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->requirePresence('website', 'create')
            ->notEmpty('website')
            ->add('website', 'valid-url', ['rule' => 'url']);

        $validator
            ->requirePresence('mail', 'create')
            ->notEmpty('mail');
        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['mail'],'Cette adresse email est déjà utilisée'));
        $rules->add($rules->isUnique(['username'],'Ce username est déjà utilisé'));
        return $rules;
    }
}
