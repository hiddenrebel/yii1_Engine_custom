<?php 
class WebUser extends CWebUser {
    // Store model to not repeat query.
    private $_model;
    // Return first name.
    // access it by Yii::app()->user->first_name
    function getFirstName(){
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->firstname;
    }
    function getFullName(){
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->fullName();
    }
    function getRole(){
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->role_user;
    }
    function getPage(){
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->pagination;
    }
    function getUsername(){
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->username;        
    }
    // This is a function that checks the field 'role'
    // in the User model to be equal to constant defined in our User class
    // that means it's admin
    // access it by Yii::app()->user->isAdmin()
    function isAdmin(){
        $user = $this->loadUser(Yii::app()->user->id);
        if ($user!==null){
            return $user->role_user == Users::ROLE_ADMIN;
        }
        else return false;
    }

    function isHeadSales(){
        $user = $this->loadUser(Yii::app()->user->id);
        if ($user!==null){
            return $user->role_user == Users::ROLE_HEADSALES;
        }
        else return false;
    }

    function isHeadIT(){
        $user = $this->loadUser(Yii::app()->user->id);
        if ($user!==null){
            return $user->role_user == Users::ROLE_HEADIT;
        }
        else return false;
    }

    function isCSO(){
        $user = $this->loadUser(Yii::app()->user->id);
        if ($user!==null){
            return $user->role_user == Users::ROLE_CSO;
        }
        else return false;
    }

    function isHeadFinance(){
        $user = $this->loadUser(Yii::app()->user->id);
        if ($user!==null){
            return $user->role_user == Users::ROLE_HEADFINANCE;
        }
        else return false;
    }

    function isDirector(){
        $user = $this->loadUser(Yii::app()->user->id);
        if ($user!==null){
            return $user->role_user == Users::ROLE_DIRECTOR;
        }
        else return false;
    }

   
    // Load user model.
    protected function loadUser($id=null) {
        if($this->_model===null)
        {
            if($id!==null)
            $this->_model=Users::model()->findByPk($id);
        }
        return $this->_model;
    }        
 
}