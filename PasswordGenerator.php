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
    private $VALID = array();
    private $password = "";

    /*
     * Default password length is 8 if no argument provided.
     * Length of password must be greater than the size of CHARS.
     */
    public function __construct($length=8) 
    {
        if (is_numeric($length) && $length >= sizeof($this->CHARS)) $this->LENGTH = $length;
        else exit("Not a valid password length. Length of password must be at least " .sizeof($this->CHARS) .".");
    }

    public function generate() 
    {
        do {
            $this->initialiseValidPasswordCheck();
            $this->password = "";

            for ($i = 1; $i <= $this->LENGTH; $i++) {
                // select a character set from CHARS and a character from that set
                $charset = rand(0, count($this->CHARS) - 1);
                $char = rand(0, strlen($this->CHARS[$charset]) - 1);

                $this->password .= $this->CHARS[$charset][$char];

                // set the character set as used
                $this->VALID[$charset] = 1;
            }
        } while (!$this->isValidPassword());

        return $this->password;
    }

    /* 
     * Initialises the VALID arrary with zeros to the same size as the CHARS array.
     * This serves to validate that each character set has been used in the pasword.
     */
    private function initialiseValidPasswordCheck() {
        for ($i = 0; $i < sizeof($this->CHARS); $i++) {
            $this->VALID[$i] = 0;
        }
    }

    private function isValidPassword()
    {
        foreach ($this->VALID as $item) {
            if ($item === 0) return false;
        }

        return true;
    }
}

?>
