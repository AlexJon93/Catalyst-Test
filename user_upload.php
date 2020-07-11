<?php
    function exception_error_handler($errno, $errstr, $errfile, $errline ) {
        throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
    }
    set_error_handler("exception_error_handler");

    function main($argc, $argv)
    {
        /**
         * initial entry function for the wider script, helps parse command line arguments and 
         * runs respective functions
         * 
         * @param Integer   $argc   number of arguments passed to the script
         * @param Array     $argv   array of arguments passed to the script
         */
        $file_name = 'users.csv';

        // checking for help directive
        if(in_array("--help", $argv)){
            return printHelp();
        }

        // checking for table creation directive
        elseif(in_array("--create_table", $argv)){
            $db_details = getDatabaseDetails($argv);
            if(!$db_details){
                echo "All database details required to create table\n";
                return FALSE;
            }
            return createTable($db_details);
        }

        // checking that file directive provided and gets it's $argv key
        $file_directive = array_search("--file", $argv);
        if($file_directive != FALSE){
            $file_name = $argv[$file_directive+1];
            $dry_run = in_array("--dry_run", $argv);
            $db_details = getDatabaseDetails($argv);

            if(!$dry_run and !$db_details){
                echo "All database details required for db insertion run\n";
                return FALSE;
            }

            return parseCSVFile($file_name, $dry_run, $db_details);
        }
    }

    function printHelp()
    {
        /**
         * simply prints out the list of directives and script usage instructions
         */
        echo    "Usage: user_upload.php [options] [--file] <file> [-h] <db host> [-u] <db user> [-p] <db password>\n".
                "Options:\n".
                "--create_table\tBuild users table without any insertion\n".
                "--dry_run\tRuns validation and parsing, without any insertion\n".
                "--file\t\tProceeding argument contains directory details for parsable csv file".
                "\n".
                "Database details required for any insertion operations to be performed\n";
    }

    function getDatabaseDetails($argv)
    {
        /**
         * gets all the provided database details from the commandline
         * 
         * @param   Array   $argv       array of arguments passed to the script
         * @return  Array   $details    array of details parsed from commandline arguments
         */

        if(in_array("-u", $argv) and in_array("-h", $argv) and in_array("-p", $argv)){
            $details = array();
            $details["user"] = $argv[array_search("-u", $argv)+1];
            $details["host"] = $argv[array_search("-h", $argv)+1];
            $details["pass"] = $argv[array_search("-p", $argv)+1];

            return $details;
        }
        return FALSE;
    }

    function createTable($db_details)
    {
        /**
         * creates postgresql users table, called by main function when --create_table 
         * directive provided
         * 
         * @param   Array   $db_details     associative array of username, password, and host details for 
         *                                  the postgres database
         * @return  Boolean $result         True if successful creation, else False
         */
        $create_query = "DROP TABLE IF EXISTS users;".
                        "CREATE TABLE users(".
                        "given_name text not null, surname text not null, email text not null unique);";
        try {
            $connection = pg_connect("host=$db_details[host] dbname=catalyst user=$db_details[user] password=$db_details[pass]");
            pg_query($connection, $create_query);
        } catch (Exception $err){
            echo "Issue with creating table: ".$err->getMessage()."\n";
            return FALSE;
        }

        echo "Table created successfully!\n";
        return TRUE;
    }

    function parseCSVFile($file_name, $dry_run = FALSE, $db_details = NULL)
    {
        /**
         * core part of the script, takes the given csv file and parses details before passing to 
         * various validation functions and db insert queries
         * 
         * @param   Array       $db_details     associative array of username, password, and host details 
         *                                      for the postgres database
         * @param   Boolean     $dry_run        boolean literal indicating whether rows are to be inserted or 
         *                                      just parsed/validated as provided by --dry_run directive
         * @param   String      $file_name      string of the file to be parsed, either constant provided 
         *                                      by the main function or via the --file directive
         * @return  Boolean     $result         True if successfully parsed, else False
         */
    }

    function insertRow($connection, $row)
    {
        /**
         * inserts given row into the postgres db
         * 
         * @param   Resource    $connection     PostgreSQL connection resource, created in parseCSVFile
         * @param   Array       $row            associative array containing row details
         * @return  Boolean     $outcome        True if successful insert, else False
         */
    }

    function validateRow($row)
    {
        /**
         * performs validation and 'cleaning' on the given row
         * @param   Array   $row            associative array containing row details
         * @return  Array   $cleaned_row    associative array containing validated/sanitised row
         */
    }

    main($argc, $argv);
?>