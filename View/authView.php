<?php

class AuthView {
    private $user = null;

    public function showLogin() {
        require './Templates/formLogin.phtml';
    }


}
