<?php
    function main($argc, $argv)
    {
        /**
         * initial entry function for the wider script, helps parse command line arguments and 
         * runs respective functions
         * 
         * @param Integer   $argc   number of arguments passed to the script
         * @param Array     $argv   array of arguments passed to the script
         */
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
    }

    function parseCSVFile($db_details, $dry_run, $file_name)
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

    function insertRow($db_details, $row)
    {
        /**
         * inserts given row into the postgres db
         * 
         * @param   Array   $db_details     associative array of username, password, and host details for 
         *                                  the postgres database
         * @param   Array   $row            associative array containing row details
         * @return  Boolean $outcome        True if successful insert, else False
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