
<?php
// Archivo: local/greetings/index.php

require_once('../../config.php');
require_once($CFG->dirroot. '/local/greetings/lib.php');
require_once($CFG->dirroot . '/local/greetings/classes/form/myform.php');
$messageform = new \local_greetings\form\message_form();

$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url(new moodle_url('/local/greetings/index.php'));
$PAGE->set_pagelayout('standard');
$PAGE->set_title(get_string('pluginname', 'local_greetings'));
$PAGE->set_heading(get_string('pluginname', 'local_greetings'));

echo $OUTPUT->header();

//Saludo basico
// if (isloggedin()) {
//     echo '<h3>Greetings, ' . fullname($USER) . '</h3>';
// } else {
//     echo '<h3>Greetings, user</h3>';
// }

// Invocar saludo desde variables en local_greetings.php
// if (isloggedin()) {
//     echo get_string('greetingloggedinuser', 'local_greetings', fullname($USER));
// } else {
//     echo get_string('greetinguser', 'local_greetings');
// }

//Invocar saludo desde una funcion de lib.php
if (isloggedin()) {
    echo local_greetings_get_greeting($USER);
} else {
    echo get_string('greetinguser', 'local_greetings');
}

// $user = $DB->get_record('user', ['id' => $USER->id]);
// echo fullname($user);


$messageform->display();
if ($data = $messageform->get_data()) {
    $message = required_param('message', PARAM_TEXT);
    echo $OUTPUT->heading($message, 4);
}



echo $OUTPUT->footer();
