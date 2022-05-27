<?php
namespace App\Table\Exception;

class NotFoundException extends \Exception {

    public function __construct(string $table){
        $this->message = "Aucun Enregistrement n'est trouvé dans la table '$table' ";
    }

}