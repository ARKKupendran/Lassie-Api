<?php

namespace app\modules\api\modules\v1\controllers;

use common\models\Users;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\web\UploadedFile;

class UsersController extends ActiveController {

    public $modelClass = 'common\models\Users';

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            'only' => ['index'],
        ];
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }

    /*public function actionIndex() {
        echo "Users Index Page";
    }*/

    public function actionRegister() {
        $user = new Users();
        $post = Yii::$app->request->getBodyParams();
        $password = (isset($post['password'])) ? $post['password'] : '';
        if (!empty($post)) {
            $user->load(Yii::$app->request->getBodyParams(), '');
            $user->auth_key = $user->generateAuthKey();
            $user->password = $user->setPassword($password);
            $user->status = 0;
            if ($profile_img = UploadedFile::getInstancesByName("profile_image")) {
                foreach ($profile_img as $file) {
                    $file_name = str_replace(' ', '-', $file->name);
                    $randno = rand(11111, 99999);
                    $path = Yii::$app->basePath . '/web/uploads/images/' . $randno . $file_name;
                    $file->saveAs($path);
                    $user->profile_image = $randno . $file_name;
                }
            } else {
                $user->profile_image = 'default.png';
            }
            if ($user->save()) {
                $values[] = [
                    'id' => $user->id,
                    'auth_key' => $user->auth_key,
                    'username' => $user->username,
                    'email' => $user->email,
                    'profile_image' => $user->profile_image,
                    'status' => $user->status
                ];
                $auth_key = $user->auth_key;
                $uid = $user->id;
                $mail_sub = 'Lassie Email Verification';
                $mail_body = "Hi " . $user->username . ",<br><br>";
                $mail_body .= "Please click the below link to activate your account. <br><br>";
                $mail_body .= " http://local.lassie/api/v1/users/emailverification?auth_key=$auth_key&uid=$uid";
                $mail_body .= " <br><br>Thank you. <br><br> <b>Regards, <br> Lassie team</b><br>";
                $emailSend = Yii::$app->mailer->compose()
                        ->setFrom(['sumanasdev@gmail.com'])
                        ->setTo($user->email)
                        ->setSubject($mail_sub)
                        ->setHtmlBody($mail_body)
                        ->send();

                if ($emailSend) {
                    return [
                        'success' => false,
                        'message' => 'Please check your email to active your account',
                        'data' => $values
                    ];
                }
            } else {
                return [
                    'success' => false,
                    'message' => 'Email Already Exists'
                ];
//                    print_r($user->getErrors()); exit;
            }
        } else {
            return [
                'success' => false,
                'message' => 'Invalid request'
            ];
        }
    }
    
    public function actionEmailverification() {
        $user = Users::find()->where(['id' => $_GET['uid']])->one();
        $db_key = $user['auth_key'];
        if ($_GET['auth_key'] == $db_key) {

            $user = new Users();
            $user = Users::find()->where(['id' => $_GET['uid']])->one();
            $user->status = 1;
            $user->save(false);
            return $this->redirect(['/site/mailverified']);
        }
    }
    
    public function actionLogin() {
        $post = Yii::$app->request->getBodyParams();
        $email = (isset($post['email'])) ? $post['email'] : '';
        $user_password = (isset($post['password'])) ? $post['password'] : '';
        if (!empty($post)) {

            if (Users::find()->where(['email' => $email])->one()) {
                if (Users::find()->where(['status' => 1])->andWhere(['email' => $email])->one()) {

                    $user = Users::find()->where(['email' => $email])->one();
                    $db_password = $user->password;
                    $valid_pass = Yii::$app->security->validatePassword($user_password, $db_password);
                    if ($valid_pass) {
                        $values[] = [
                            'id' => $user->id,
                            'auth_key' => $user->auth_key,
                            'username' => $user->username,
                            'email' => $user->email,
                            'profile_image' => $user->profile_image,
                        ];
                        return [
                            'success' => true,
                            'message' => 'Login successful',
                            'data' => $values
                        ];
                    } else {
                        return [
                            'success' => false,
                            'message' => 'Password is wrong',
                        ];
                    }
                } else {
                    return [
                        'success' => false,
                        'message' => 'Sorry, Your account is inactive. Please check email to activate your account',
                    ];
                }
            } else {
                return [
                    'success' => false,
                    'message' => 'Invalid Email',
                ];
            }
        }
    }

}
