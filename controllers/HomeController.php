<?php
namespace App\Controllers;

use App\Controllers\Controller;

class HomeController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        echo "This is index method of the home controller";
        return;
    }

    public function home() {
        echo "This is home method of the home controller";
        return;
    }
}