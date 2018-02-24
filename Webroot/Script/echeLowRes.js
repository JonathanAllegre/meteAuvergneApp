baseUrl = $('#baseUrl').attr('url');
$('#ex1').slider({
    formatter: function(value) {
        img = baseUrl + "/"+value+".png";
        $('#imgMap').attr('src', img);
        return 'Current value: ' + value;
    }
});