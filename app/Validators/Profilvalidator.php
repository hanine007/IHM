<?php
namespace app\Validators;
use app\Post_table;
use Valitron\Validator;
use app\Validators\Abstractvalidator;


class Profilvalidator extends Abstractvalidator{
    
    
   
    
    
    public function __construct(array $data)
    {
        parent::__construct($data);
       
        
        /* Validator::addRule('already_exist', function($field, $value) {
            return $this->post_table->exist($field,$value,$this->post);
        }, 'already_exist');
 */
        
        $this->v->rule('email', 'email');
        $this->v->rule('required', ['email','username']);
       
        
    }

   
}