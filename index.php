<?php
require 'Company.php';
require 'FileDB.php';
require 'ModelCompany.php';
define('TABLE', 'companies');

print "Choose action you want to make:\n";
print "1.Add Company\n2.Edit Company\n3.Delete Company\n";
$option = fgets(STDIN);

switch($option) {
    case 1:
        addCompany();
        break;
    case 2:
        editCompany();
        break;
    case 3: 
        deleteCompany();
        break;
    default:
        print "There is only 3 options! Try again";
}

function deleteCompany() {
    $db = new FileDb('db.txt');
    $modelCompany = new ModelCompany($db, TABLE);
    
    print "Enter company ID you want to delete:\n";
    foreach($modelCompany->loadAll() as $company) {
        $ids = trim($company->getId());
        $names = trim($company->getName());
        print "ID: '{$ids}' and company name is '{$names}'\n";
    };
    $id = fgets(STDIN);
    if($modelCompany->delete($id)) {
        print "Company successfuly deleted !";
    }
}

function editCompany() {
    $db = new FileDb('db.txt');
    $modelCompany = new ModelCompany($db, TABLE);
    $company = new Company;

    print "Enter company ID you want to edit:";
    $id = fgets(STDIN);
    validate_id(trim($id));
    print "Edit company name: ";
    $name = fgets(STDIN);
    print "Edit company registration code: ";
    $reg_code = fgets(STDIN);
    print "Edit company email: ";
    $email = fgets(STDIN);
    $email = validate_email(trim($email));
    print "Edit company phone: ";
    $phone = fgets(STDIN);
    $phone = validate_phone(trim($phone));
    print "Edit comment: ";
    $comment = fgets(STDIN);

    $company->setData([
       'id' => $id,
       'name' => $name,
       'registration_code' => $reg_code,
       'email' => $email,
       'phone' => $phone,
       'comment' => $comment
    ]);
    if($modelCompany->update($id, $company)) {
        print "Company successfully edited!";
    }
}

function addCompany() {
    $db = new FileDb('db.txt');
    $modelCompany = new ModelCompany($db, TABLE);
    $company = new Company;
    
    print "Enter your company ID: ";
    $id = fgets(STDIN);
    print "Enter your company name: ";
    $name = fgets(STDIN);
    print "Enter your company registration code: ";
    $reg_code = fgets(STDIN);
    print "Enter your company email: ";
    $email = fgets(STDIN);
    $email = validate_email(trim($email));
    print "Enter you company phone: ";
    $phone = fgets(STDIN);
    $phone = validate_phone(trim($phone));
    print "Enter comment: ";
    $comment = fgets(STDIN);

    $company->setData([
       'id' => $id,
       'name' => $name,
       'registration_code' => $reg_code,
       'email' => $email,
       'phone' => $phone,
       'comment' => $comment
    ]);
    if($modelCompany->insert($id, $company)) {
        print "Company successfully added!";
    } else {
        print "Company was not added becouse there is already company with same ID";
    }
}

function validate_email($email) {
    $db = new FileDb('db.txt');
    $modelCompany = new ModelCompany($db, TABLE);
    $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";

    if (preg_match($pattern, $email)) {
        foreach ($modelCompany->loadAll() as $company) {
            if(trim($company->getEmail()) === $email) {
                
                print "Email exists or invalid email: ";
                $email = fgets(STDIN);
                validate_email(trim($email)); 
            }
        }
    } else {
        print "Wrong email! Try again: ";
        $email = fgets(STDIN);
        validate_email(trim($email));
    }
    return $email;
}

function validate_id($id) {
    $db = new FileDb('db.txt');
    $modelCompany = new ModelCompany($db, TABLE);

    foreach($modelCompany->loadAll() as $company) {
        if(trim($company->getId()) === $id) {
            return true;
        }
        
    print "Wrong ID:";
    $id = fgets(STDIN);  
    validate_id(trim($id));
    }
}

function validate_phone($phone) {
    if (preg_match("/^[8]{1}[6]{1}[0-9]{7}$/", $phone)) {
        return $phone;
    } else if (preg_match("/^[+]{1}[3]{1}[7]{1}[0]{1}[6]{1}[0-9]{7}$/", $phone)) {
        return $phone;
    }
    
    print "Wrong phone number! Try again: ";
    $phone = fgets(STDIN);
    validate_phone(trim($phone));
    return $phone;
}
?>






