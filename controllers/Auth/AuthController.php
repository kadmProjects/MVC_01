<?php
namespace App\Controllers\Auth;

use App\Controllers\Controller;

class AuthController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        echo "This is index method of the auth controller";
        return;
    }

    public function home() {
        echo "This is home method of the auth controller";
        return;
    }
}