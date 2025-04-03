$(document).ready(function(){
    var button = $('#button');
    var modal = $('#modal');
    var close = $('#close');

    button.on('click', function(){
        modal.show('modal');
    });
    
    close.on('click', function(){
        modal.hide('modal');
    });
});