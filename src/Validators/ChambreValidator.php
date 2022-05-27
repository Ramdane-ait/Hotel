<?php
namespace App\Validators;

use App\Table\ChambreTable;

class ChambreValidator extends AbstractValidator {

    public function __construct(array $data,ChambreTable $table,?int $clientId = null){
        parent::__construct($data);

        $this->validator->rule('required',['nom','type_id','description','prix']);
        $this->validator->rule('numeric','prix');
        $this->validator->rule('lengthMin',['nom','description'],3);
    }
}