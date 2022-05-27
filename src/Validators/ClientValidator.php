<?php
namespace App\Validators;

use App\Table\ClientTable;

class ClientValidator extends AbstractValidator {

    public function __construct(array $data,ClientTable $table,?int $clientId = null){
        parent::__construct($data);

        $this->validator->rule('required',['nom','prenom','email','date_naiss','sexe','tel','adresse','mdp']);
        $this->validator->rule('lengthMin','mdp',8);
        $this->validator->rule('length','tel',10);
        $this->validator->rule('email','email');
        $this->validator->rule(function ($field,$value) use ($table,$clientId) {
            return !$table->exists($field,$value,$clientId);
        },['email','tel'],'Cette valeur est deja utilisée');
        $this->validator->rule('equals','mdp','confirmation');
        $this->validator->rule('date','date_naiss');
        $this->validator->rule('in','sexe',['homme','femme']);
        $this->validator->rule('regex','tel','/^0[675][0-9]{8}$/');
        $this->validator->rule('numeric','tel');
    }
}