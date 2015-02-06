<?php
/**
 * Created by PhpStorm.
 * User: Thibault
 * Date: 03/02/2015
 * Time: 09:09
 */

// @isGranted('admin')
Blade::extend(function($value, $compiler)
{
    $pattern = $compiler->createMatcher('isGranted');

    $replace = '<?php if ($2 == Auth::user()->role->name) { ?>';

    return preg_replace($pattern, '$1'.$replace, $value);
});

// @endIsGranted
Blade::extend(function($value, $compiler) {
    $pattern = $compiler->createPlainMatcher('endIsGranted');

    $replace = '<?php } ?>';

    return preg_replace($pattern, '$1'.$replace, $value);
});