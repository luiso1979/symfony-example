<?php
/**
 * Created by PhpStorm.
 * User: luiso
 * Date: 07/04/15
 * Time: 22:02
 */

namespace AppBundle\Utils;


use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class JsonLoader {
    public function loadObject($fileName, $type) {
        $locator = new FileLocator(array(__DIR__.'/../../..'));
        $path = $locator->locate($fileName);

        $string = file_get_contents($path);

        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $treasure = $serializer->deserialize($string, $type, 'json');

        return $treasure;
    }

    public function loadAllObjects($prefix, $type) {
        $objects = array();
        $idx = 1;
        while(true) {
            try {
                $obj = $this->loadObject($prefix.$idx++.'.json', $type);
                array_push($objects, $obj);
            }catch (Exception $e) {
                break;
            }
        }
        return $objects;
    }
}