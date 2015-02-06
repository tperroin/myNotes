<?php
/**
 * Created by PhpStorm.
 * User: Thibault
 * Date: 03/02/2015
 * Time: 11:33
 */

class Sessions extends Eloquent {

    public $timestamps = false;

    public function cours()
    {
        return $this->belongsTo('Cours');
    }

    public function formateur()
    {
        return $this->belongsTo('Formateur');
    }

    public function students()
    {
        return $this->belongsToMany('Student');
    }
}