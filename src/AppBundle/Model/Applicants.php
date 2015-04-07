<?php
/**
 * Created by PhpStorm.
 * User: luiso
 * Date: 07/04/15
 * Time: 22:48
 */

namespace AppBundle\Model;


class Applicants {
    private $richiedenti;

    /**
     * @return mixed
     */
    public function getRichiedenti()
    {
        return $this->richiedenti;
    }

    /**
     * @param mixed $richiedenti
     */
    public function setRichiedenti($richiedenti)
    {
        $this->richiedenti = $richiedenti;
    }

    public function getMostWantedObject($treasures) {
        $map = $this->buildObjectsMap($treasures);
        foreach($this->richiedenti as $applicant) {
            foreach($applicant['oggetti'] as $obj) {
                if (array_key_exists($obj['id'], $map)) {
                    $map[$obj['id']]->amount += $obj['quantita'];
                }
            }
        }
        return $this->maxPair($map);
    }

    private function buildObjectsMap($treasures) {
        $map = array();
        foreach($treasures as $treasure) {
            foreach($treasure->getOggetti() as $obj) {
                if (!array_key_exists($obj['id'], $map)) {
                    $pair = new Pair();
                    $pair->object = $obj;
                    $map[$obj['id']] = $pair;
                }
            }
        }
        return $map;
    }

    private function maxPair($map) {
        $maxPair = null;
        foreach($map as $key => $pair) {
            if ($maxPair === null or $maxPair->amount < $pair->amount) {
                $maxPair = $pair;
            }
        }
        return $maxPair;
    }
}

class Pair {
    public $object;
    public $amount = 0;
}