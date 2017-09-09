<?php

namespace Fundamentary\App\Models;

use Api\Models\UsersModel as User;

class UserModel extends User {
    
    /**
     * Proceso de llenado de las relaciones permitidas y filtrado de las relaciones ocultas, otorgadas
     * al modelo Rest.
     *
     * @param  array  $data
     * @return  array
     */
    public function getTuples($data) {
        foreach($this->tuples as $tuple)
            $tuples[$tuple] = $data[$tuple];
        foreach($this->hidden_tuples as $hidden_tuple)
            unset($tuples[$hidden_tuple]);
        return $tuples;
    }
}