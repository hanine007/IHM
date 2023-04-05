<?php
namespace app\Validators;
use Valitron\Validator;
use app\Validators\Abstractvalidator;


class Categoryvalidator extends Abstractvalidator{
    
    
    private $post_category;
    private ?int $category;
    
    
    public function __construct(array $data,$post_category,?int $category)
    {
        parent::__construct($data);
        $this->post_category=$post_category;
        $this->category=$category;
        
        Validator::addRule('already_exist', function($field, $value) {
            return $this->post_category->exist($field,$value,$this->category);
            
        }, 'already_exist');

        
        $this->v->rule('required', ['name', 'slug']);
        $this->v->rule('already_exist', ['name', 'slug']); 
        $this->v->rule('slug', ['slug']);
        $this->v->rule('lengthBetween',  ['name', 'slug'], 3, 200); 
       
        
    }

   
}