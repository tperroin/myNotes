<?php
/**
 * Created by PhpStorm.
 * User: Thibault
 * Date: 03/02/2015
 * Time: 11:33
 */

class Classroom extends Eloquent {

    public function curriculum()
    {
        return $this->belongsTo('Curriculum');
    }

} 