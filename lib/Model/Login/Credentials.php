<?php

namespace Model\Login;

class Credentials {
# version 5
    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }
}
?>
