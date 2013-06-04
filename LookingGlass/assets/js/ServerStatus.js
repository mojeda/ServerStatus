$('#status').load('uptime.php?lg=true');
function updateStatus(){
    $('#status').load('uptime.php?lg=true');
}
setInterval( "updateStatus()", 15000 );