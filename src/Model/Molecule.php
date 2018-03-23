<?php

namespace App\Model;

use LogicException;

class Molecule
{

    /** @var string */
    private $type;

    /** @var array */
    private $atoms;

    /** @var string */
    private $name;

    /**
     * Molecule constructor.
     * @param string $type
     */
    public function __construct(string $type)
    {
        $this->type = $type;
    }

    /**
     * @param Atom $atom
     * @return Molecule
     */
    public function addAtom(Atom $atom): Molecule
    {
        $this->name = null;
        $this->atoms[] = $atom;
        return $this;
    }

    /**
     * @return Molecule
     */
    public function merge(): Molecule
    {
        if (count($this->atoms) < 2) {
            throw new LogicException("Method merge() require at least 2 atoms");
        }

        foreach ($this->atoms as $atom) {
            $this->name .= $atom->getSymbol();
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getAtoms(): array
    {
        return $this->atoms;
    }
}