<?php


namespace App\Entity;

abstract class Entity
{
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
