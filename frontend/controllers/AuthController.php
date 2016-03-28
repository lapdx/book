<?php

namespace frontend\controllers;
use common\models\db\User;

use Yii;

class AuthController extends BaseController {

    /**
     * Trang chủ backend
     * @return type
     */
    public function actionIndex() {
        if(!Yii::$app->user->isGuest) return $this->redirect($this->baseUrl);
        $request = Yii::$app->request;
        $username = trim($request->post('username', ''));
        if ($request->isPost) {
            $user = User::findByUsername($username);
            if($user){
                $pwd = trim($request->post('pwd', ''));
                if($user->validatePassword($pwd)){
                    Yii::$app->user->login($user);
                    $this->redirect($this->baseUrl);
                }else Yii::$app->session->setFlash('danger','<b>Lỗi!</b> Mật khẩu không đúng');
            }else Yii::$app->session->setFlash('danger','<b>Lỗi!</b> Tên đăng nhập không tồn tại'); 
        }
        return $this->render('login',['username'=>$username]);
    }
    public function actionTest() {
        var_dump(Yii::$app->user->isGuest);return;
        $user = User::findByUsername('admin');
        var_dump($user->validatePassword('1234568'));return;
        $session = Yii::$app->session;
        return $this->render('login');
    }
    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->redirect($this->baseUrl);
    }
    public function actionSignup(){
        $request = Yii::$app->request;
        $data = array();
        $data['username']   = trim($request->post('username', ''));
        $data['fullname']   = $request->post('fullname', '');
        $data['phone']      = $request->post('phone', '');
        $data['email']      = trim($request->post('email', ''));
        if ($request->isPost) {
            $data['pwd']        = trim($request->post('pwd', ''));
            $data['pwd2']       = trim($request->post('pwd2', ''));
            if($data['pwd'] != $data['pwd2']) Yii::$app->session->setFlash('danger','<b>Lỗi!</b> Mật khẩu xác nhận không đúng');
            elseif(User::findByUsername($data['username'])) Yii::$app->session->setFlash('danger','<b>Lỗi!</b> Tên đăng nhập đã tồn tại');
            else{
                $user = new User();
                $user->username = $data['username'];
                $user->password = User::hashPassword($data['pwd']);
                $user->active   = 1;
                $user->type     = 'customer';
                $user->email    = $data['email'];
                $user->fullname = $data['fullname'];
                $user->phone    = $data['phone'];
                if(!$user->save()) Yii::$app->session->setFlash('danger','Đã có lỗi xảy ra');
                else{
                    if(!Yii::$app->user->isGuest) Yii::$app->user->logout();
                    Yii::$app->user->login($user);
                    $this->redirect($this->baseUrl);
                }
            }
        }
        return $this->render('signup',['data'=>$data]);
    }
}
