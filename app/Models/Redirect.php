<?php
namespace App\Models;

class Redirect {

    public function to($path) {
        if(!empty($path)) {
            return header('Location: ' . $path);
        }

    }

}