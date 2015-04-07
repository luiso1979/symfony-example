<?php

namespace AppBundle\Model;


class Treasure {
    private $id;
    private $oggetti;

    /**
     * @return mixed
     */
    public function getOggetti()
    {
        return $this->oggetti;
    }

    /**
     * @param mixed $oggetti
     */
    public function setOggetti($oggetti)
    {
        $this->oggetti = $oggetti;
    }

    public function getObjectValue() {
        return array_reduce($this->oggetti, function($a, $b) {
            return $a + $b['valore'];
        });
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}