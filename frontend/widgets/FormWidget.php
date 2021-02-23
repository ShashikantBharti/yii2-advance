<?php


namespace frontend\widgets;


use yii\base\Widget;
use yii\helpers\Html;

class FormWidget extends Widget
{

    public $action = null;
    public $heading = null;
    public $labels = null;

    public function init()
    {
        parent::init();
        if($this->action === null){
            $this->action = 'login';
        }
        if($this->heading === null){
            $this->heading = 'Login Form';
        }
        if($this->labels === null){
            $this->labels = ['username','password'];
        }
    }

    public function run()
    {
        $html = '
            <h1>'.$this->heading.'</h1>
            <form method="post" action="'.$this->action.'">
            <hr>
                <div class="form-group">
                    <label for="'.str_replace(' ','',ucwords($this->labels[0])).'">'.ucwords($this->labels[0]).'</label>
                    <input type="text" class="form-control" name="'.str_replace(' ','',ucwords($this->labels[0])).'" placeholder="'.ucwords($this->labels[0]).'" id="'.str_replace(' ','',ucwords($this->labels[0])).'"/>
                    <div class="help-block"></div>
                </div>
                <div class="form-group">
                    <label for="'.str_replace(' ','',ucwords($this->labels[1])).'">'.ucwords($this->labels[1]).'</label>
                    <input type="text" class="form-control" name="'.str_replace(' ','',ucwords($this->labels[1])).'" placeholder="'.ucwords($this->labels[1]).'" id="'.str_replace(' ','',ucwords($this->labels[1])).'" />
                    <div class="help-block"></div>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="rememberMe">
                    <label for="rememberMe">Remember Me?</label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        ';
        return $html;
    }

}