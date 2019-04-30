$(document).ready(function() {
    $('#mailing').submit(function(event) {
        $('#errors').empty();
        var formData = {
            'forename'              : $('input[name=forename]').val(),
            'surname'              : $('input[name=surname]').val(),
            'email'             : $('input[name=email]').val(),
            'dob'               : $('input[name=dob]').val()
        };
        $.ajax({
            type        : 'POST',
            url         : 'mail.php',
            data        : formData,
            dataType    : 'json',
            encode      : true
        })
            .done(function(data) {
            	console.log(data);
                if (!data.success) {
                    if (data.message.forename) {
                        $('#errors').append('<br>' + data.message.forename);
                    }
                    if (data.message.surname) {
                        $('#errors').append('<br>' + data.message.surname);
                    }
                    if (data.message.email) {
                        $('#errors').append('<br>' + data.message.email);
                    }
                    if (data.message.dob) {
                        $('#errors').append('<br>' + data.message.dob); 
                    }
                } else {
                    alert('Thank you for joining our mailing list');
                    window.location.href = "index.html";
                }
             });
        event.preventDefault();
    });
});