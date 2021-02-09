<?php

namespace App\Entity;

/**
 * Class Entity
 *
 * @package App\Entity
 */
abstract class Entity
{
    /**
     * @param array $donnees
     */
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $methode = 'set'.ucfirst($key);
            if (method_exists($this, $methode)) {
                $this->$methode($value);
            }
        }
    }
}
