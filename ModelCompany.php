<?php
class ModelCompany {
    private $table_name;
    private $db;

    public function __construct(FileDB $db, $table_name) {
        $this->table_name = $table_name;
        $this->db = $db;
    }

    public function insert($id, Company $user) {
        if (!$this->db->getRow($this->table_name, $id)) {
            $this->db->setRow($this->table_name, $id, $user->getData());
            $this->db->save();

            return true;
        } else {
            return false;
        }
    }

    public function update($id, Company $user) {
        if ($this->db->getRow($this->table_name, $id)) {
            $this->db->setRow($this->table_name, $id, $user->getData());
            $this->db->save();

            return true;
        } else {
            return false;
        }
    }

    public function delete($id) {
        if ($this->db->getRow($this->table_name, $id)) {
            $this->db->deleteRow($this->table_name, $id);
            $this->db->save();

            return true;
        } else {
            return false;
        }
    }
    
    public function loadAll() {
        $companies = [];

        foreach ($this->db->getRows($this->table_name) as $company) {
            $companies[] = new Company($company);
        }

        return $companies;
    }
}