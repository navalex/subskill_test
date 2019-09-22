<?php

namespace App\Serializer;

class PostCircularReferenceHandler {
    public function __invoke($object) {
        return $object->getId();
    }
}
