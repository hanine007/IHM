<?php 

namespace app\Validators;

use Valitron\Validator;

abstract class Abstractvalidator{
    
    protected array $data;
    protected Validator $v;
  
    public function __construct(array $data)
    {
        $this->data=$data;
        $this->v=new Validator($this->data);
    }

    public function validate(){
       return $this->v->validate();
    }

    public function errors(){
        return $this->v->errors();
    }
}