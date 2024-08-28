<?php

namespace local_greetings\form;

// moodleform is defined in formslib.php
require_once("$CFG->libdir/formslib.php");

class myform extends \moodleform {
    // Add elements to form.
    public function definition() {
        // A reference to the form is stored in $this->form.
        // A common convention is to store it in a variable, such as `$mform`.
        $mform = $this->_form; // Don't forget the underscore!
        // Add elements to your form.
        $mform->addElement('text', 'email', get_string('email'));
        // Set type of element.
        $mform->setType('email', PARAM_NOTAGS);
        // Default value.
        $mform->setDefault('email', 'Please enter email');
    }
    // Custom validation should be added here.
    function validation($data, $files) {
        return [];
    }
}

// Agregar esto a index.php para invocar el metodo:
// // Instantiate the myform form from within the plugin.
// $mform = new \local_greetings\form\myform();
// // Form processing and displaying is done here.
// if ($mform->is_cancelled()) {
//     // If there is a cancel element on the form, and it was pressed,
//     // then the `is_cancelled()` function will return true.
//     // You can handle the cancel operation here.
// } else if ($fromform = $mform->get_data()) {
//     // When the form is submitted, and the data is successfully validated,
//     // the `get_data()` function will return the data posted in the form.
// } else {
//     // This branch is executed if the form is submitted but the data doesn't
//     // validate and the form should be redisplayed or on the first display of the form.
//     // Set default data (if any).
//     $mform->set_data($toform);
//     // Display the form.
//     $mform->display();
// }