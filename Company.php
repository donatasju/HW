<?php 
class Company {
    private $data;
    
    public function __construct($data = null) {
        if (!$data) {
            $this->data = [
                'id' => null,
                'name' => null,
                'registration_code' => null,
                'email' => null,
                'phone' => null,
                'comment' => null,
            ];
        } else {
            $this->setData($data);
        }
    }
    
    public function setId($id) {
        $this->data['id'] = $id;
    }
    
    public function getId() {
        return $this->data['id'];
    }
    
    public function setName(string $name) {
        $this->data['name'] = $name;
    }
    
    public function getName() {
        return $this->data['name'];
    }

    public function setEmail(string $email) {
        $this->data['email'] = $email;
    }
    
    public function getEmail() {
        return $this->data['email'];
    }

    public function setRegistrationCode($registration_code) {
        $this->data['registration_code'] = $registration_code;
    }
    
    public function getRegistrationCode() {
        return $this->data['registration_code'];
    }
    public function setPhone($phone) {
        $this->data['phone'] = $phone;
    }
    
    public function getPhone() {
        return $this->data['phone'];
    }

    public function setComment(string $comment) {
        $this->data['comment'] = $comment;
    }
    
    public function getComment() {
        return $this->data['comment'];
    }

    public function setData(array $data) {
        $this->setId($data['id'] ?? null);
        $this->setName($data['name'] ?? '');
        $this->setRegistrationCode($data['registration_code'] ?? null);
        $this->setEmail($data['email'] ?? '');
        $this->setPhone($data['phone'] ?? null);
        $this->setComment($data['comment'] ?? '');
    }

    public function getData() {
        return $this->data;
    }
}