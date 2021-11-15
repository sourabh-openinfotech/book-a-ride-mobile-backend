<?php

namespace app\core\requests;

use app\core\services\UserService;
use Yii;

class LoginRequest extends \yii\base\Model
{
    public $user_name;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_name'], 'filter', 'filter' => 'trim'],
            [['user_name', 'password'], 'required'],

            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = UserService::getUserByUsernameOrEmail($this->user_name);
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, t('app', 'Incorrect user_name or password.'));
            }
            Yii::$app->user->setIdentity($user);
        }
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
