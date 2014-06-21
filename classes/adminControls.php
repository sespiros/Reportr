<?php
class adminControls
{
    private $db_connection      = null;
    public  $submit_successful  = false;
    public  $errors             = array();
    public  $messages           = array();

    public function __construct()
    {
        // if we have such a POST request, call the registerNewUser() method
        if (isset($_POST["markClosed"])) {
            $this->markReportClosed($_POST['report_id'], $_POST['comment']);
        }

    }

    /**
     * Checks if database connection is opened and open it if not
     */
    private function databaseConnection()
    {
        // connection already opened
        if ($this->db_connection != null) {
            return true;
        } else {
            // create a database connection, using the constants from config/config.php
            try {
                $this->db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
                return true;
            } catch (PDOException $e) {
                $this->errors[] = "Database error";
                return false;
            }
        }
    }

    private function markReportClosed($id, $comment)
    {
        if ($this->databaseConnection()) {
            // 1. Mark report as closed in web_reports table
            $sql1 = "
                UPDATE web_reports SET status=:stat, time_closed=NOW() WHERE id=:report_id
                    ";
            $report_close = $this->db_connection->prepare($sql1);
            $report_close->bindValue(':stat',   "Closed",   PDO::PARAM_STR);
            $report_close->bindValue(':report_id',   $id,   PDO::PARAM_STR);
            $report_close->execute();
		
            // 2. Add comment in web_report_details
            $sql2 = "
                UPDATE web_report_details SET comment=:comment WHERE report_id=:report_id
                    ";
            $report_comment = $this->db_connection->prepare($sql2);
            $report_comment->bindValue(':comment',   $comment,   PDO::PARAM_STR);
            $report_comment->bindValue(':report_id',   $id,   PDO::PARAM_STR);
            $report_comment->execute();
		
            $this->messages[] = "Report " . $id . " marked as closed";
            $this->submit_successful = true;

		}
	}


}
