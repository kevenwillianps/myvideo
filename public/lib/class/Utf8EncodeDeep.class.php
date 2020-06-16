<?php
/**
 * Created by PhpStorm.
 * User: KEVEN
 * Date: 25/03/2020
 * Time: 08:28
 */

class Utf8EncodeDeep
{

    public function utf8_encode_deep(&$input) {
        if (is_string($input)) {
            $input = utf8_encode($input);
        } else if (is_array($input)) {
            foreach ($input as &$value) {
                $this->utf8_encode_deep($value);
            }
            unset($value);
        } else if (is_object($input)) {
            $vars = array_keys(get_object_vars($input));
            foreach ($vars as $var) {
                $this->utf8_encode_deep($input->$var);
            }
        }
    }

}