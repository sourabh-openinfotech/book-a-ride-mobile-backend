<?php

namespace app\core\requests;

use app\core\models\User;

class JoinRequest extends \yii\base\Model
{
    public $user_name;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_name', 'email'], 'trim'],
            [['user_name', 'email'], 'required'],

            [
                'user_name',
                'match',
                'pattern' => '/^[a-z]\w*$/i',
                'message' => t('app', '{attribute} can only be numbers and letters.')
            ],
            ['user_name', 'unique', 'targetClass' => User::class],
            ['user_name', 'string', 'min' => 4, 'max' => 60],

            ['email', 'string', 'min' => 2, 'max' => 120],
            ['email', 'unique', 'targetClass' => User::class],
            ['email', 'email'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_name' => t('app', 'user_name'),
            'password' => t('app', 'Password'),
            'email' => t('app', 'Email'),
        ];
    }
}
