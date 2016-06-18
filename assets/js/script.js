/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function myDateFormatter() {
    var d = new Date(dateObject);
    var day = d.getDate();
    var month = d.getMonth() + 1;
    var year = d.getFullYear();
    if (day < 10) {
        day = "0" + day;
    }
    if (month < 10) {
        month = "0" + month;
    }
    var date = day + "/" + month + "/" + year;

    return date;
}


function  today_date() {
    var todayTimeStamp = new Date; // Unix timestamp in milliseconds
    var diff = todayTimeStamp;
    var todaydayDate = new Date();
    var month = todaydayDate.getMonth() + 1;
    var day = todaydayDate.getDate();
    if (day < 10) {
        day = "0" + day;
    }
    if (month < 10) {
        month = "0" + month;
    }
    var todaydayDate = todaydayDate.getFullYear() + '-' + (month) + '-' + day;
    return todaydayDate;
}

function CompareDate(startDate, endDate) {
    var start = new Date(startDate);
    var end = new Date(endDate);
    var dateOne = new Date(start.getFullYear(), start.getMonth(), start.getDay()); //Year, Month, Date
    var dateTwo = new Date(end.getFullYear(), end.getMonth(), end.getDay()); //Year, Month, Date
    if (startDate > endDate) {
        return 1;
    } else {
        return 0;
    }
}
function  get_month(month) {
    switch (month) {
        case 1:
            return "Jan";
            break;
        case 2:
            return "Feb";
            break;
        case 3:
            return "Mar";
            break;
        case 4:
            return "Apr";
            break;
        case 5:
            return "May";
            break;
        case 6:
            return "Jun";
            break;
        case 7:
            return "Jul";
            break;
        case 8:
            return "Aug";
            break;
        case 9:
            return "Sep";
            break;
        case 10:
            return "Oct";
            break;
        case 11:
            return "Nov";
            break;
        case 12:
            return "Dec";
            break;
            Default:
                    return "";
            
    }
}

$(document).ready(function() {


    $("#password-reset").parsley({trigger: "keypress"});
    $("#login").parsley({trigger: "keypress"});
    $("#register").parsley({trigger: "keypress"});
    $("#admin-register").parsley({trigger: "keypress"});
    $("#dev-uploadgame").parsley({trigger: "keypress"});
    $("#admin-create-comeptiton").parsley({trigger: "keypress"});
    $("#searchform").parsley({trigger: "keypress"});
    $("#send-message").parsley({trigger: "keypress"});
    $("#withdraw").parsley({trigger: "keypress"});

    $(function() {
        $.datepicker.setDefaults({
            beforeShow: customRange,
            dateFormat: 'yy-mm-dd',
            firstDay: 1,
            changeFirstDay: false,
            onSelect: function() {
                this.onchange();
                this.onblur();
            }
        });
    });
///////////////////////////////////////////////////////////
    function customRange(input) {
        var min = null, // Set this to your absolute minimum date
                dateMin = min,
                dateMax = null,
                dayRange = 365; // Restrict the number of days for the date range
        if (input.id === "datepicker") {
            if ($("#datepicker1").datepicker("getDate") != null) {
                dateMax = $("#datepicker1").datepicker("getDate");
                dateMin = new Date();
                if (dateMin < min) {
                    dateMin = min;
                }
            }
            else
            {
                dateMin = new Date();
                dateMax = new Date(dateMin.getFullYear(), dateMin.getMonth(), dateMin.getDate() + dayRange);
                if (dateMin < min) {
                    dateMin = min;
                }
            }
        } else if (input.id === "datepicker1") {

            if ($('#datepicker').datepicker('getDate') != null) {
                dateMin = $('#datepicker').datepicker('getDate');
                var ajj_Date = new Date();
                if (CompareDate(dateMin, ajj_Date) === 0) {
                    dateMin = new Date();
                }
                dateMax = new Date(dateMin.getFullYear(), dateMin.getMonth(), dateMin.getDate() + dayRange);
            }
            else {
                dateMin = new Date();
                dateMax = new Date(dateMin.getFullYear(), dateMin.getMonth(), dateMin.getDate() + dayRange);
            }
        }
        else if (input.id === "datepicker2") {
            dateMax = new Date();
        }
        return {
            minDate: dateMin,
            maxDate: dateMax
        };
    }
//////////////////////////////////////////////////////////

    // Form Submit button disabler
    $('#withdraw').submit(function() {
        $(this).parent('form').submit();
        $(this).hide();
        $(this).after('<span class="disabled-text">Please Wait<span>');
        $(this).parent('form :input').prop('disabled', true);
    });

    $( '.show_child_div' ).hide();
    $( '.show_child' ).click(function() {
        $( this ).next('.show_child_div').toggle();
    });

    $(function() {
        if ($('#active_players').length > 0 || $('#active_competitions').length > 0) {
            var players = document.getElementById('aplayers');
            var player_counts = players.getAttribute('data-player');
            var active_players = JSON.parse(player_counts);
            var player_months = [];
            var player_values = [];
            for (var i = 0; i < active_players.length; i++) {
                player_months.push(get_month(parseInt(active_players[i].month)));
                player_values.push(parseInt(active_players[i].value));
            }
            ///////// for competitons////////////
            var competitions = document.getElementById('acompetitions');
            var competitions_counts = competitions.getAttribute('data-competition');

            var active_competitions = JSON.parse(competitions_counts);
            var competitions_months = [];
            var competitions_values = [];
            for (var i = 0; i < active_competitions.length; i++) {
                competitions_months.push(get_month(parseInt(active_competitions[i].month)));
                competitions_values.push(parseInt(active_competitions[i].value));
            }
            //  console.log(competitions_months);
            //  console.log(competitions_values);
            ////// active  player graph///////
            $('#active_players').highcharts({
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Monthly Source Cars'
                },
                xAxis: {
                    categories: player_months
                },
                yAxis: {
                    title: {
                        text: 'Cars'
                    }
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: false
                    }
                },
                series: [{
                        name: 'Months',
                        data: player_values
                    }]
            });
////////////////////////////////////////////////////////

////// active  Competitions graph///////
            $('#active_competitions').highcharts({
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Monthly Sold Cars'
                },
                xAxis: {
                    categories: competitions_months
                },
                yAxis: {
                    title: {
                        text: 'Cars'
                    }
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: false
                    }
                },
                series: [{
                        name: 'Months',
                        data: competitions_values
                    }]
            });
        }
    });
/////////// fading error message/////////////////////////////////////////////
    setTimeout(function() {
        $('.errormsg,.successmsg').fadeOut('slow');
    }, 4000); // <-- time in milliseconds

////////////////////////

    // Jquery UI modal Window
    $('.modal-game-portal').dialog();


    $("input[type='number']").keypress(function(e) {
        //if the letter is not digit then display error and don't type anything

        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            $(this).prev("#err").html("<span>Digits Only</span>").show().delay(1000).fadeOut(200);
            return false;
        }
    });
    
    $( '.add_more_emails' ).click(function(){
        $( '.rows' ).append('<div class="parent_div"><input type="email" name="emails[]" data-parsley-required data-type="integer" /><a href="javascript:" class="remove_emails">remove</a></div>');
    });
    
    $( 'body' ).on('click', '.remove_emails', function () {
        $( this ).parent('.parent_div').remove();
    });
    
     ///////////////////
    $("#profileImage").on("change", function()
    {
        $('.dp-img').attr("src", URL.createObjectURL(this.files[0]));
    });
    //////////////////
    

});
