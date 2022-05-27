<?php
namespace App\Table;

use App\Model\Contact;

class ContactTable extends Table {

    protected $class = Contact::class;
    protected $table = 'contact';

    public function createContact(Contact $contact){
        $id = $this->create([
            'email' => $contact->getEmail(),
            'message' => $contact->getMessage()
        ]);
        
        $contact->setId($id);   
    }

}