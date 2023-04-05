<?php
namespace app\Validators;
use app\Post_table;
use Valitron\Validator;
use app\Validators\Abstractvalidator;


class Assetvalidator extends Abstractvalidator{
    
    
   
    
    
    public function __construct(array $data)
    {
        parent::__construct($data);
       
        
        /* Validator::addRule('already_exist', function($field, $value) {
            return $this->post_table->exist($field,$value,$this->post);
        }, 'already_exist');
 */
        
        $this->v->rule('required', ['title', 'description','price','qnt','category','chain']);
        /* $this->v->rule('already_exist', ['name', 'slug']); */ 
        $this->v->rule('lengthBetween',  ['title'], 3, 10);
        $this->v->rule('lengthBetween',  ['description'], 50, 1000);  
       
        
    }

   
}