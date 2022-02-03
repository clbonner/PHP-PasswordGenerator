<?php

/* PHP Password Generator
 * 
 * Usage: $pw = new PasswordGenerator(password length);
 *        $pw->generate();
 * 
 * List of special characters taken from OWASP
 * https://owasp.org/www-community/password-special-characters
 * Some operating system or applications may have limitations on this.
 * 
 */

class PasswordGenerator 
{
    private $CHARS = [
        "ABCDEFGHIJKLMNOPQRSTUVWXYZ",
        "abcdefghijklmnopqrstuvwxyz",
        "0123456789",
        " !\"#$%&'()*+,-./:;<=>?@[\]^_`{|}~"
    ];
    
    private $LENGTH; 

    // Default length is 8 if no argument provided
    public function __construct($length=8) 
    {
        if (is_numeric($length)) $this->LENGTH = $length;
        else exit("Not a valid password length.");
    }

    public function generate() 
    {
        $password = "";

        for ($i = 1; $i <= $this->LENGTH; $i++) {
            $charset = rand(0, count($this->CHARS) - 1);
            $char = rand(0, strlen($this->CHARS[$charset]) - 1);
            $password .= $this->CHARS[$charset][$char];
        }

        return $password;
    }
}

?>
