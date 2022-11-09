<?php
include_once '../classes/db.class.php';
require_once('../middleware/mailer.php');
// user extends from class DB, so that we can use the database connection made in the DB class
class Mail extends DB {

    public function sendUpdateInfoVerfMail($email) {
        try {
            ob_start();
            $random = rand(11111,99999);
            include('../resources/mails/verification_code.php');
            $body = ob_get_clean();
            
            $userCreated = DB::insert("INSERT INTO verify_codes(user_id, code) values(?,?)", [$_SESSION['id'], $random]);
            
            newMail($email, "Local_eshop - verification-code", $body);
        } catch (\Throwable $th) {
        }
    }

    public function sendWorkerTempPass($tempPass, $contact) {
        try {
            ob_start();
            $randomPass = $tempPass;
            include('../resources/mails/temp_worker_pass.php');
            $body = ob_get_clean();
            newMail($contact, "Local_eshop - temporary-password", $body);
            return true;
        } catch (\Throwable $th) {
        }
    }

    public function sendTempPass($tempPass, $contact) {
        try {
            ob_start();
            $randomPass = $tempPass;
            include('../resources/mails/temp_pass.php');
            $body = ob_get_clean();
            newMail($contact, "Local_eshop - temporary-password", $body);
            return true;
        } catch (\Throwable $th) {
        }
    }
    
}