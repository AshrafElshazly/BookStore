<?php 

namespace Source\Validation;

use Source\Validation\Rules\ValidationRule;

class ValidationStratge
{

    private $validationRule;

    public function __construct(ValidationRule $validationRule)
    {
      $this->validationRule = $validationRule;  
    }

    public function validate()
    {
      return  $this->validationRule->validate();
    }
}