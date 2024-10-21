<?php

class AuthView {
    private $user = null;

    public function showLogin() {
        require 'templates/formLogin.phtml';
    }


}
