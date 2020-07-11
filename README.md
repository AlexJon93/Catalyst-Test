# Catalyst PHP Test - Alex Jarvis
## Installation/Setup

In php.ini confirm ``extension=pgsql`` is not commented

requires:
```
php-pgsql == 7.2.31
```
## Assumptions
The following are assumptions made around the requirements provided:
- Filename details are required to be provided for any parsing to take place
- Likewise database details are required to be provided for any insertion or table creation.
- Rows with invalid emails do not end the script, but merely output an error and skip the row
- Rows that contain fields with invalid characters (e.g Mich!@ael for name) are sanitised.
- Invalid characters for Given Name/Surnames are: Numeric characters [0-9], all non-alphanumeric characters except ' and -