<?php
namespace App\Validators;

use App\Table\ClientTable;

class ClientModifValidator extends AbstractValidator {

    public function __construct(array $data,ClientTable $table,?int $clientId = null){
        parent::__construct($data);

        $this->validator->rule('required',['email','tel','adresse']);
        $this->validator->rule('length','tel',10);
        $this->validator->rule('email','email');
        $this->validator->rule('regex','tel','/^0[675][0-9]{8}$/');
        $this->validator->rule('numeric','tel');
    }
}