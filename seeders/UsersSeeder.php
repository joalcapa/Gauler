<?php

namespace Gauler\Seeders;

use Gauler\api\models\UsersModel as Users;

class UsersSeeder {

    public function boom() {
        $users = new Users();
        $users->name = 'admin';
        $users->email = 'admin@admin.com';
        $users->password = hashBCrypt('123456789Password');
        $users->save();
    }
}