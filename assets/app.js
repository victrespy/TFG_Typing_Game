import './stimulus_bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

tailwind.config = {
    theme: {
        extend: {
            fontFamily: {
                'pixel': ['"VT323"', 'monospace'],
            },
            colors: {
                'p-dark': '#819A91',    /* Verde Oscuro (Fondo) */
                'p-mid': '#A7C1A8',     /* Verde Medio (Cajas secundarias / Cura) */
                'p-light': '#D1D8BE',   /* Verde Claro (Botones / Daño) */
                'p-pale': '#EEEFE0',    /* Crema (Texto claro) */
            }
        }
    }
}