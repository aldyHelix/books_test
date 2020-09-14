function deleteData(route){
    $('#modal-delete').modal('show');
    var route = route
    $("#form-delete").attr('action', route);
}
function deleteDataMultiply(route){
    var id = [];
    $('.delete-checkbox:checked').each(function(){
        id.push(parseInt($(this).val()));
    });
    if(id.length > 0){
        $('#modal-delete').modal('show');
        var route = route
        
        $.each(id, function( index, value ) {
            $('#ids').append('<input type="hidden" name="ids[]" value="'+value+'"/>');
        });
        $("#form-delete").attr('action', route);
    } else { $('#modal-delete-empty').modal('show');}
     
}
