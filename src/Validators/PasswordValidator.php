<?php
namespace App\Validators;

use App\Table\ClientTable;

class PasswordValidator extends AbstractValidator {

    public function __construct(array $data,ClientTable $table,?int $clientId = null){
        parent::__construct($data);

        $this->validator->rule('required',['mdp','New-mdp','confirm_Newmdp']);
        $this->validator->rule('lengthMin',['New-mdp','confirm_Newmdp'],8);
        $this->validator->rule(function ($field,$value) use ($table,$clientId) {
            return password_verify($value,$table->findMdp($clientId));
        },'mdp','Mot de passe incorrect');
        $this->validator->rule('equals','New-mdp','confirm_Newmdp');
    }
}