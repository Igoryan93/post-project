<?php
namespace App\Controllers;

use Delight\Auth\Auth;
use League\Plates\Engine;
use App\Models\QueryBuilder;
use Faker\Factory;
use PDO;


class HomeController {
    private $pdo, $templates, $query;

    public function __construct(PDO $pdo, Engine $engine, QueryBuilder $queryBuilder, Auth $auth) {
        $this->templates = $engine;
        $this->pdo = $pdo;
        $this->query = $queryBuilder;
        $this->auth = $auth;
    }

    public function index() {

        if ($this->auth->isRemembered()) {
            flash()->info('Здравствуйте ' . $this->auth->getUsername());
        }

        $users = $this->query->selectAll('users');
        asort($users);
        echo $this->templates->render('home', ['users' => $users]);
    }

    public function post($id) {

        $users = $this->query->selectAll('users', $id['id']);
        asort($users);
        echo $this->templates->render('home', ['users' => $users]);
    }

    public function notFound() {
        echo $this->templates->render('404', ['name' => '404']);
    }



}
