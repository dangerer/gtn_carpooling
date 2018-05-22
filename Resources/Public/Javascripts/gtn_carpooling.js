


/* for smalot datetimepicker */
/*var datePickerConfiguration = {
    language:  'de',
    format: "dd.mm.yyyy - hh:ii",
    todayBtn: true,
    autoclose: true,
    todayHighlight: true

}*/

/* for eonasdan datetimepicker */
var datePickerConfiguration = {
    //debug: true
    format: "DD.MM.YYYY HH:mm",
    sideBySide: true,
    //showTodayButton: true,
    icons: {
        time: 'glyphicons glyphicons-clock',
        date: 'glyphicons glyphicons-calendar',
        up: 'glyphicons glyphicons-chevron-up',
        down: 'glyphicons glyphicons-chevron-down',
        previous: 'glyphicons glyphicons-chevron-left',
        next: 'glyphicons glyphicons-chevron-right',
        today: 'glyphicons glyphicons-target',
        clear: 'glyphicons glyphicons-bin',
        close: 'glyphicons glyphicons-remove'
    }

 }

/*
var datePickerConfiguration = {
    autoclose: true,
    format: 'dd.mm.yyyy H:m',
    language: 'de-DE',
    minViewMode: 0,
    maxViewMode: 2,
    todayBtn: true,
    todayHighlight: true,
    orientation: 'component'
}*/

function dateTimePickerEnable() {
    //$('.dateTimePicker').datepicker(datePickerConfiguration);
    $('.dateTimePicker').datetimepicker(datePickerConfiguration);
    $('.open-datepicker').on('click', function(event) {
        event.preventDefault();
        element = $(this).closest('.date').find('.dateTimePicker').first();
        element.datetimepicker('toggle');
    });
}

$(document).ready(function() {
    dateTimePickerEnable();
})