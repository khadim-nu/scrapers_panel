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

$(document).ready(function () {

    $('body').on('click', '.btn_wrap_a', function () {
        $(".loading-sheet").show();
    });

    $('body').on('click', '.btn_submit', function () {
        if ($('#domain_url').val().length > 8)
            $(".loading-sheet").show();
    });


    $("#password-reset").parsley({trigger: "keypress"});
    $("#login").parsley({trigger: "keypress"});
    $("#register").parsley({trigger: "keypress"});
    $("#admin-register").parsley({trigger: "keypress"});
    $("#dev-uploadgame").parsley({trigger: "keypress"});
    $("#admin-create-comeptiton").parsley({trigger: "keypress"});
    $("#searchform").parsley({trigger: "keypress"});
    $("#send-message").parsley({trigger: "keypress"});
    $("#withdraw").parsley({trigger: "keypress"});

    $(function () {
        $.datepicker.setDefaults({
            beforeShow: customRange,
            dateFormat: 'yy-mm-dd',
            firstDay: 1,
            changeFirstDay: false,
            onSelect: function () {
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
            } else
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
            } else {
                dateMin = new Date();
                dateMax = new Date(dateMin.getFullYear(), dateMin.getMonth(), dateMin.getDate() + dayRange);
            }
        } else if (input.id === "datepicker2") {
            dateMax = new Date();
        }
        return {
            minDate: dateMin,
            maxDate: dateMax
        };
    }
//////////////////////////////////////////////////////////

    $('.show_child_div').hide();
    $('.show_child').click(function () {
        $(this).next('.show_child_div').toggle();
    });
/////////// fading error message/////////////////////////////////////////////
    setTimeout(function () {
        $('.errormsg,.successmsg').fadeOut('slow');
    }, 4000); // <-- time in milliseconds

////////////////////////

    // Jquery UI modal Window


    $("input[type='number']").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything

        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            $(this).prev("#err").html("<span>Digits Only</span>").show().delay(1000).fadeOut(200);
            return false;
        }
    });

    $('.add_more_emails').click(function () {
        $('.rows').append('<div class="parent_div"><input type="email" name="emails[]" data-parsley-required data-type="integer" /><a href="javascript:" class="remove_emails">remove</a></div>');
    });

    $('body').on('click', '.remove_emails', function () {
        $(this).parent('.parent_div').remove();
    });

    ///////////////////
    $("#profileImage").on("change", function ()
    {
        $('.dp-img').attr("src", URL.createObjectURL(this.files[0]));
    });
    //////////////////


    $('#section').on('change', function () {
        var options = "";
        switch (this.value) {
            case "1":
                options += '<option selected="selected" value="0">--Select Category--</option>';
                options += '<option value="2">Antiques</option>';
                options += '<option value="3">Art</option>';
                options += '<option value="4">Baby</option>';
                options += '<option value="5">Books</option>';
                options += '<option value="6">Business &amp; Industrial</option>';
                options += '<option value="7">Cameras &amp; Photo</option>';
                options += '<option value="10">Clothing &amp; Accessories</option>';
                options += '<option value="12">Collectibles</option>';
                options += '<option value="13">Computers &amp; Office</option>';
                options += '<option value="14">Consumer Electronics</option>';
                options += '<option value="15">Dolls &amp; Bears</option>';
                options += '<option value="16">DVDs &amp; Movies</option>';
                options += '<option value="42">Everything Else</option>';
                options += '<option value="18">Food &amp; Wine</option>';
                options += '<option value="19">Gifts &amp; Occasions</option>';
                options += '<option value="20">Health &amp; Beauty</option>';
                options += '<option value="21">Hobbies &amp; Crafts</option>';
                options += '<option value="23">Home &amp; Furniture</option>';
                options += '<option value="22">Home Appliances</option>';
                options += '<option value="24">Jewelry, Gems, Watches</option>';
                options += '<option value="43">Marine</option>';
                options += '<option value="27">Music &amp; Instruments</option>';
                options += '<option value="29">Networking &amp; Telecom</option>';
                options += '<option value="30">PDAs</option>';
                options += '<option value="31">Pet Supplies</option>';
                options += '<option value="32">Pottery &amp; Glass</option>';
                options += '<option value="44">Services &amp; Trades</option>';
                options += '<option value="35">Sporting Goods</option>';
                options += '<option value="36">Sports Memorabilia</option>';
                options += '<option value="37">Stamps</option>';
                options += '<option value="1569">Tickets &amp; Vouchers</option>';
                options += '<option value="38">Toys</option>';
                options += '<option value="39">Travel</option>';
                options += '<option value="40">TV</option>';
                options += '<option value="41">Video Games</option>';
                options += '<option value="1573">Tools</option>';
                break;
            case "2":
                options += '<option selected="selected" value="0">--Select Category--</option>';
                options += '<option value="181">Cars</option>';
                options += '<option value="26">Motorcycles</option>';
                options += '<option value="1571">Quad Bikes</option>';
                options += '<option value="1570">Scooters</option>';
                options += '<option value="182">Vans &amp; Trucks</option>';
                options += '<option value="183">Vehicle Parts</option>';
                options += '<option value="1572">Other</option>';
                break;

            case "3":
                options += '<option selected="selected" value="0">--Select Category--</option>';
                options += '<option value="248">Property For Sale</option>';
                options += '<option value="247">Long Lets</option>';
                options += '<option value="246">Short / Holiday Lets</option>';
                break;

            case "4":
                options += '<option selected="selected" value="0">--Select Category--</option>';
                options += '<option value="1501">Accounting</option>';
                options += '<option value="1502">Admin &amp; Clerical</option>';
                options += '<option value="1503">Automotive</option>';
                options += '<option value="1504">Banking</option>';
                options += '<option value="1505">Biotech &amp; Health Care</option>';
                options += '<option value="1506">Business Development</option>';
                options += '<option value="1507">Business Opportunity</option>';
                options += '<option value="1508">Construction</option>';
                options += '<option value="1509">Consultant</option>';
                options += '<option value="1510">Customer Service</option>';
                options += '<option value="1511">Design</option>';
                options += '<option value="1512">Distribution &amp; Shipping</option>';
                options += '<option value="1513">Education</option>';
                options += '<option value="1514">Engineering</option>';
                options += '<option value="1515">Entry Level</option>';
                options += '<option value="1516">Executive</option>';
                options += '<option value="1517">Facilities</option>';
                options += '<option value="1518">Finance</option>';
                options += '<option value="1519">Franchise</option>';
                options += '<option value="1520">General Business   </option>';
                options += '<option value="1521">General Labor</option>';
                options += '<option value="1522">Government</option>';
                options += '<option value="1523">Grocery</option>';
                options += '<option value="1524">Hospitality &amp; Hotel</option>';
                options += '<option value="1525">Human Resources</option>';
                options += '<option value="1526">Information Technology</option>';
                options += '<option value="1527">Installation / Maint / Repair</option>';
                options += '<option value="1528">Insurance</option>';
                options += '<option value="1529">Inventory</option>';
                options += '<option value="1530">Legal</option>';
                options += '<option value="1531">Legal Admin</option>';
                options += '<option value="1532">Management</option>';
                options += '<option value="1533">Manufacturing</option>';
                options += '<option value="1534">Marketing</option>';
                options += '<option value="1535">Media / Journalism / Newspaper</option>';
                options += '<option value="1536">Nonprofit &amp; Social Services</option>';
                options += '<option value="1537">Nurse</option>';
                options += '<option value="1538">Other  </option>';
                options += '<option value="1539">Pharmaceutical  </option>';
                options += '<option value="1540">Professional Services  </option>';
                options += '<option value="1541">Purchasing &amp; Procurement  </option>';
                options += '<option value="1542">QA</option>';
                options += '<option value="1543">Quality Control  </option>';
                options += '<option value="1544">Real Estate  </option>';
                options += '<option value="1545">Research  </option>';
                options += '<option value="1546">Restaurant &amp; Food Service  </option>';
                options += '<option value="1547">Retail  </option>';
                options += '<option value="1548">Sales  </option>';
                options += '<option value="1549">Science  </option>';
                options += '<option value="1550">Skilled Labor &amp; Trades  </option>';
                options += '<option value="1551">Strategy / Planning  </option>';
                options += '<option value="1552">Supply Chain  </option>';
                options += '<option value="1553">Telecommunications  </option>';
                options += '<option value="1554">Training  </option>';
                options += '<option value="1555">Transportation  </option>';
                options += '<option value="1556">Veterinary Services  </option>';
                options += '<option value="1557">Warehouse  </option>';

                break;

            case "11":
                options += '<option selected="selected" value="0">--Select Category--</option>';
                options += '<option value="1565">Charity</option>';
                options += '<option value="1563">Cultural</option>';
                options += '<option value="1562">Entertainment</option>';
                options += '<option value="1567">Fundraising</option>';
                options += '<option value="1568">Religious</option>';
                options += '<option value="1564">Sport</option>';
                options += '<option value="1566">Other</option>';
                break;

            default :
        }

        $("#category").html(options);
    });


});
