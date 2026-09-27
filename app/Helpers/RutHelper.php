<?php

namespace App\Helpers;

class RutHelper
{
    /**
     * Valida si un RUT chileno es correcto mediante Módulo 11.
     */
    public static function isValid(string $rut): bool
    {
        // 1. Limpiar puntos, guiones y pasar a mayúscula
        $rut = strtoupper(str_replace(['.', '-'], '', trim($rut)));

        if (strlen($rut) < 2) {
            return false;
        }

        $cuerpo = substr($rut, 0, -1);
        $dv = substr($rut, -1);

        if (!is_numeric($cuerpo)) {
            return false;
        }

        // 2. Algoritmo Módulo 11
        $suma = 0;
        $multiplicador = 2;

        for ($i = strlen($cuerpo) - 1; $i >= 0; $i--) {
            $suma += (int) $cuerpo[$i] * $multiplicador;
            $multiplicador = $multiplicador == 7 ? 2 : $multiplicador + 1;
        }

        $esperado = 11 - ($suma % 11);
        $dvEsperado = match ($esperado) {
            11 => '0',
            10 => 'K',
            default => (string) $esperado,
        };

        return $dv === $dvEsperado;
    }

    /**
     * Limpia el RUT para guardarlo en la base de datos (opcional).
     */
    public static function clean(string $rut): string
    {
        return strtoupper(str_replace(['.', '-'], '', trim($rut)));
    }
}
