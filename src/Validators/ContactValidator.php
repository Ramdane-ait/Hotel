<?php
namespace App\Validators;


class ContactValidator extends AbstractValidator {

    public function __construct(array $data){
        parent::__construct($data);

        $this->validator->rule('required',['email','message']);
        $this->validator->rule('email','email');
        $this->validator->rule('lengthMin','contact_message',3);
    }
}