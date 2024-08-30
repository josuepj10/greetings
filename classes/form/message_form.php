<?php

namespace local_greetings\form;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');

class message_form extends \moodleform {
    /**
     * Define the form.
     */
    public function definition() {
        $mform = $this->_form; // Don't forget the underscore!

        $mform->addElement('textarea', 'message', get_string('yourmessage', 'local_greetings')); // Add elements to your form.
        $mform->setType('message', PARAM_TEXT); // Set type of element.

        $submitlabel = get_string('submit');
        $mform->addElement('submit', 'submitmessage', $submitlabel);
    }
}