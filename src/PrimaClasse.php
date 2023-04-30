<?php

namespace Sensorario\DependencyInjection;

class PrimaClasse
{
    public function __construct(private SecondaClasse $secondaClasse)
    {

    }
    public function primoMetodo(AltraClasseNuova $nuova)
    {
        return $nuova->ciaone() . ' ' . $this->secondaClasse->metodo();
    }
}