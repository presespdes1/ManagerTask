<?php

namespace App;

enum State : string
{
    case PENDIENTE = "pendiente";
    case PROGRESO = "en progreso";
    case COMPLETADA = "completada";
}
