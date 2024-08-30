
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

//Require users to login
require_login();

// Do not allow guest user
if (isguestuser()) {
    throw new moodle_exception('noguest');
}

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
$messages = $DB->get_records('local_greetings_messages');

echo $OUTPUT->box_start('card-columns');

foreach ($messages as $m) {
    echo html_writer::start_tag('div', ['class' => 'card']);
    echo html_writer::start_tag('div', ['class' => 'card-body']);
    echo html_writer::tag('p', format_text($m->message, FORMAT_PLAIN), ['class' => 'card-text']);
    echo html_writer::start_tag('p', ['class' => 'card-text']);
    echo html_writer::tag('small', userdate($m->timecreated), ['class' => 'text-muted']);
    echo html_writer::end_tag('p');
    echo html_writer::end_tag('div');
    echo html_writer::end_tag('div');
}

echo $OUTPUT->box_end();

if ($data = $messageform->get_data()) {
    $message = required_param('message', PARAM_TEXT);

    if (!empty($message)) {
        $record = new stdClass;
        $record->message = $message;
        $record->timecreated = time();

        $record->userid = $USER->id;
        
        $DB->insert_record('local_greetings_messages', $record);
    }
}



echo $OUTPUT->footer();
