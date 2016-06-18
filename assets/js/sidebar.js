$(function() {
    $('#sidebar').hover(
            function()
            {
                console.log($('#sidebar').is(':animated'));
                if (!$('#sidebar ul .text').is(':animated'))
                {
                    $(this).css("width", "221px");
                    $('#sidebar ul .text').fadeIn(100);
                }
            }, function()
    {
        if (!$('#sidebar ul .text').is(':animated')) {
            $(this).css("width", "84px");
            $('#sidebar ul .text').fadeOut(200);
        }
    }
    );
}); 