<?php
namespace App\Validators;


class ConnexionValidator extends AbstractValidator {

    public function __construct(array $data){
        parent::__construct($data);

        $this->validator->rule('required',['email','mdp']);
        $this->validator->rule('email','email');
    }
}