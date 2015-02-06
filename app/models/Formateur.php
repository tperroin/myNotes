<?php
/**
 * Created by PhpStorm.
 * User: Thibault
 * Date: 03/02/2015
 * Time: 11:33
 */

class Formateur extends Eloquent {

    public function user()
    {
        return $this->belongsTo('User');
    }

}