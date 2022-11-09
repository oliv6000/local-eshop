<?php
include_once '../classes/db.class.php';
include_once '../classes/mailing.class.php';
// user extends from class DB, so that we can use the database connection made in the DB class
class Users extends DB {

    public function getUser($id) {
        $userData = DB::selectFirst("SELECT * FROM users WHERE id = ?", [$id]);
        return $userData;
    }

    public function getUserWithEmail($email) {
        $userData = DB::selectFirst("SELECT * FROM users WHERE email = ?", [$email]);
        return $userData;
    }
    
    public function getUsers() {
        $users = DB::selectAll("SELECT * FROM users");
        return $users;
    }

    public function getCustomers() {
        $customers = DB::selectAll("SELECT * FROM users WHERE role='customer'");
        return $customers;
    }

    public function getWorkers() {
        $workers = DB::selectAll("SELECT * FROM users WHERE role='worker'");
        return $workers;
    }

    public function createUser($name, $email, $address, $phone, $password) {
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $userCreated = DB::insert("INSERT INTO users(name, email, address, phone, password) values(?,?,?,?,?)", [$name, $email, $address, (int)$phone, $hashed]);
    }

    public function createWorker($name, $email, $address, $phone) {
        $password = $random = rand(1111111,9999999);
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $sentCode = (new Mail())->sendWorkerTempPass($password, $email);
        if($sentCode) {
            $userCreated = DB::insert("INSERT INTO users(name, email, address, phone, password, role) values(?,?,?,?,?,'worker')", [$name, $email, $address, (int)$phone, $hashed]);
            return $userCreated;
        }
    }

    public function promoteUser($user_id) {
        $userCreated = DB::update("UPDATE users SET role='worker' WHERE id=?", [$user_id]);
    }

    public function demoteUser($user_id) {
        $userCreated = DB::update("UPDATE users SET role='customer' WHERE id=?", [$user_id]);
    }

    public function getVerifyCode($id, $verf_code) {
        $result = DB::selectFirst("SELECT * FROM verify_codes WHERE user_id=? AND code=?", [$id, $verf_code]);
        return $result;
    }

    public function deleteVerifyCode($id) {
        $result = DB::delete("DELETE FROM verify_codes WHERE id=?", [$id]);
        return $result;
    }

    public function updateUserInfo($name, $email, $address, $phone, $user_id) {
        $userCreated = DB::update("UPDATE users SET name=?, email=?, address=?, phone=? WHERE id=?", [$name, $email, $address, $phone, $user_id]);
        return $userCreated;
    }

    public function updatePassword($password, $user_id) {
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $userCreated = DB::update("UPDATE users SET password=? WHERE id=?", [$hashed, $user_id]);
    }
}