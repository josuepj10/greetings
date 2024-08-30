<?php

/**
 * Plugin strings are defined here.
 *
 * @package     local_greetings
 * @category    string
 * @copyright   2024 Your Name <jperez@aacrom.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 function local_greetings_get_greeting($user) {
    if ($user == null) {
        return get_string('greetinguser', 'local_greetings');
    }

    $country = $user->country;
    switch ($country) {
        case 'ES': // España
            $langstr = 'greetinguseres';
            break;
        case 'AU': // Australia
            $langstr = 'greetinguserau';
            break;
        case 'FJ': // Fiji
            $langstr = 'greetinguserfj';
            break;
        case 'NZ': // Nueva Zelanda
            $langstr = 'greetingusernz';
            break;
        case 'CR': // Costa Rica
            $langstr = 'greetingusercr';
            break;
        default:
            $langstr = 'greetingloggedinuser';
            break;
    }

    return get_string($langstr, 'local_greetings', fullname($user));
}

/**
* Insertar un enlace a index.php en el menú de navegación de la página principal del sitio.
*
* @param navigation_node $frontpage Nodo que representa la página principal en el árbol de navegación.
*/
function local_greetings_extend_navigation_frontpage(navigation_node $frontpage) {
    global $USER;
    // Verificar si el usuario ha iniciado sesión y no es un usuario invitado.
    if (isloggedin() && !isguestuser()) {
        $frontpage->add(
            get_string('pluginname', 'local_greetings'),
            new moodle_url('/local/greetings/index.php')
        );
    }
}


/**
* Este paso es opcional.
* Este paso se aplica a los sitios que utilizan el tema Clásico.
* Agregar enlace a index.php en el bloque de navegación.
*
* @param global_navigation $root Nodo que representa el árbol de navegación global.
*/
function local_greetings_extend_navigation(global_navigation $root) {
    $node = navigation_node::create(
        get_string('greetings', 'local_greetings'),
        new moodle_url('/local/greetings/index.php'),
        navigation_node::TYPE_CUSTOM,
        null,
        null,
        new pix_icon('t/message', '')
    );

    $root->add_node($node);
}
