$(document).ready( function() {
    $('#container_id').fileTree({ root: '/some/folder/' }, function(file) {
        alert(file);
    });
});