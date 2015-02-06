<?php
/**
 * Created by PhpStorm.
 * User: Thibault
 * Date: 03/02/2015
 * Time: 11:33
 */

class Student extends Eloquent {

    public function classroom()
    {
        return $this->belongsTo('Classroom');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

} 