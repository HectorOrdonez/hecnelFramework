/**
 * Dashboard Default JS Library
 *
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 12:35
 **/

$(function() {
    $('#insertForm').submit(function() {
        var url = $(this).attr('action');
        var data = $(this).serialize();

        $.post(url, data, function(o){
            var data = JSON.parse(o);
            addToTable(data);
        });
        return false;
    });

    $.get('getListings', function(o){
        $.each(o, function (key, array){
           addToTable(array);
        });
    }, 'json');

    $('#tableInserts').delegate('.del','click', function(){
        var url = $(this).attr('href');
        var id = $(this).attr('rel');

        var delItem = $(this);

        $.post(url, {'id':id}, function(o)
        {
            delItem.parent(this).parent(this).remove();
        });
        return false;
    });

});

function addToTable(array)
{
    $('#tableInserts').append(
        "<tr>" +
        "   <td>" + array.data + "</td>" +
        "   <td><a href='deleteData' rel=" + array.id + " class='del'>Delete</a></td>" +
        "</tr>"
    );
}