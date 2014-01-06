/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * Date: 3/01/14 2:00
 */

jQuery(document).ready(function () {
    jQuery('#triggerContainer').find('a').click(function () {
        var action = jQuery(this).attr('id');
        var amount = jQuery('#dogAmount').val();
        
        switch(action){
            case 'create':
                addLog('Creating a bunch of Dogs (' + amount + ').');
                actionCreate();
                break;
            case 'read':
                addLog('Reading a bunch of Dogs (' + amount + ').');
                actionRead();
                break;
            case 'update':
                addLog('Updating a bunch Dogs (' + amount + ').');
                actionUpdate();
                break;
            case 'delete':
                addLog('Deleting a bunch of Dogs (' + amount + ').');
                actionDelete();
                break;
        }
    });
});

function addLog(message)
{
    var element = document.createElement('div');
    element.innerHTML = message;
    
    jQuery('#log').append(element);
}

function actionRead()
{
    var url = root_url + '/test4/getDoggies';

    jQuery.ajax({
        type: 'post',
        url: url
    }).done(
        function (rawData) {
            var data = jQuery.parseJSON(rawData);
            
            addLog('Dog received! Id: ' + data.id + ' Name: ' + data.name + ', Age ' + data.age + ', Breed ' + data.breed);
        }
    ).fail(
        function (rawData) {
            var data = jQuery.parseJSON(rawData.responseText);
            var errorMessage = data.errorMessage;
            addLog('Error searching a dog; ' + errorMessage);
        }
    );
}
function actionCreate()
{
    var url = root_url + '/test4/createDogs';
    
    var dogName = jQuery('#dogName').val();
    var dogAge = jQuery('#dogAge').val();
    var dogBreed = jQuery('#dogBreed').val();

    jQuery.ajax({
        type: 'post',
        url: url,
        data: {
            dogName: dogName,
            dogAge: dogAge,
            dogBreed: dogBreed
        }
    }).done(
        function (rawData) {
            var data = jQuery.parseJSON(rawData);

            addLog('Dog created! New Dog Id: ' + data.id );
        }
    ).fail(
        function (rawData) {
            var data = jQuery.parseJSON(rawData.responseText);
            var errorMessage = data.errorMessage;
            addLog('Error making a doggy; ' + errorMessage);
        }
    );
}

function actionUpdate()
{
    var url = root_url + '/test4/changeDogs';
    var data = jQuery('#dogForm').serialize();
    
    jQuery.ajax({
        type: 'post',
        url: url,
        data: data
    }).done(
        function () {
            addLog('Dog changed!');
        }
    ).fail(
        function (rawData) {
            var data = jQuery.parseJSON(rawData.responseText);
            var errorMessage = data.errorMessage;
            addLog('Error modifying a dog; ' + errorMessage);
        }
    );
}

function actionDelete()
{
    var url = root_url + '/test4/dogMassacre';
    var dogId = jQuery('#dogId').val();

    jQuery.ajax({
        type: 'post',
        url: url,
        data: {
            dogId: dogId
        }
    }).done(
        function () {
            addLog('Dog deleted!');
        }
    ).fail(
        function (rawData) {
            var data = jQuery.parseJSON(rawData.responseText);
            var errorMessage = data.errorMessage;
            addLog('Error deleting a dog; ' + errorMessage);
        }
    );   
}