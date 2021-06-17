<?php

namespace Helpers;

/**
 * Ayudas para el manejo de arreglos
 * 
 * @author Michael Velasco <maicolvelasco55@gmail.com>
 */
class ArrayHelper{

    /**
     * Convierte un array a un objeto
     *
     * @param array $array
     * @return ArrayObject
     */
    public static function toObject(array $array){
        $object = new ArrayObject();
        foreach ($array as $key => $value) {
            $object->{$key} = is_array($value) ? ArrayHelper::toObject($value) : $value;
        }
        return $object;
    }


}

class ArrayObject extends \stdClass{
    public function __call($key, $params){
        if (!isset($this->{$key})) {
            throw new \Exception("Call to undefined method " . __CLASS__ . "::" . $key . "()");
        }
        return call_user_func_array($this->{$key}, $params);
    }
}