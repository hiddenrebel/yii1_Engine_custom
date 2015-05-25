<?php 
class SearchFormWidget extends CWidget
{
    /**
     * Is called when $this->beginWidget() is called
     */
    public function init()
    {

    }
   
    /**
     * Is called when $this->endWidget() is called
     */
    public function run()
    {

        $model = new BlogPost;
       
        // display the login form
        $this->render('SearchFormWidget', array('model'=>$model));
    }
}