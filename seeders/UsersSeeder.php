<?php

namespace Gauler\Seeders;

use Gauler\api\models\UsersModel as Users;

class UsersSeeder {

    public function boom() {
        $user = new Users();
        $user->name = 'admin';
        $user->email = 'admin@admin.com';
        $user->password = hashBCrypt('123456789Password');
        $user->save();
    }
}