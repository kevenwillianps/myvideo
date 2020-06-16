<?php
/**
 * Created by PhpStorm.
 * User: KEVEN
 * Date: 18/07/2019
 * Time: 13:26
 */

class ArrayUtf8Encode
{

    function utf8_converter($array)
    {

        array_walk_recursive($array, function(&$item, $key){

            if(!mb_detect_encoding($item, 'utf-8', true)){

                $item = utf8_encode($item);

            }

        });

        return $array;

    }

}