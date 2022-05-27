<?php
namespace App\Validators;

use DateTime;

class ReservationValidator extends AbstractValidator {
    public function __construct(array $data){
        parent::__construct($data);

        $this->validator->rule('required',['dateA','dateD']);
        $this->validator->rule('dateAfter',['dateA','dateD'],(new DateTime('-1 day'))->format('Y-m-d'));
    }
}
