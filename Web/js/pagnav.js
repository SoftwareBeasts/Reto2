$(document).ready(function() {
    var currPagecountry = 0;
    var originalRowsShowncountry = 12;
    var rowsShowncountry = 12;
    var rowsTotalcountry = $('#country tbody tr').length;
    var numPagescountry = Math.ceil(rowsTotalcountry / rowsShowncountry);
    if (numPagescountry > 1) {
        $('#country').after('<div id="navcountry">' + '<ul class="pagination">' + '<li id="lileftcountry"><a id="leftcountry" href="#toherecountry"></a></li>' + '<li class="disabled"><span id="centercountry"></span></li>' + '<li><a id="showcountry" href="#toherecountry"></a></li>' + '<li id="lirightcountry"><a id="rightcountry" href="#toherecountry"></a></li>' + '</ul>' + '</div>');
        $('#data').after('<a name="toherecountry"></a>');
        $('#leftcountry').text('previous');
        $('#centercountry').text((currPagecountry + 1) + '/' + numPagescountry);
        $('#rightcountry').text('next');
        $('#showcountry').text('show all');
    }
    $("#leftcountry").attr("disabled", "disabled");
    $("#lileftcountry").addClass('disabled');
    $('#country tbody tr').hide();
    $('#country tbody tr').slice(0, rowsShowncountry).show();
    $('#leftcountry').bind('click', function() {
        if (currPagecountry != 0) {
            currPagecountry--;
            $('#centercountry').text((currPagecountry + 1) + '/' + numPagescountry);
            $("#rightcountry").removeAttr("disabled");
            $('#lirightcountry').removeClass('disabled');
            if (currPagecountry == 0) {
                $("#leftcountry").attr("disabled", "disabled");
                $("#lileftcountry").addClass('disabled');
            }
            var startItemcountry = currPagecountry * rowsShowncountry;
            var endItemcountry = startItemcountry + rowsShowncountry;
            $('#country tbody tr').css('opacity', '0.0').hide().slice(startItemcountry, endItemcountry).css('display', 'table-row').animate({
                opacity: 1
            }, 300);
        }
    });
    $('#rightcountry').bind('click', function() {
        if (currPagecountry != numPagescountry - 1) {
            currPagecountry++;
            $('#centercountry').text((currPagecountry + 1) + '/' + numPagescountry);
            $("#leftcountry").removeAttr("disabled");
            $('#lileftcountry').removeClass('disabled');
            if (currPagecountry == numPagescountry - 1) {
                $("#rightcountry").attr("disabled", "disabled");
                $("#lirightcountry").addClass('disabled');
            }
            var startItemcountry = currPagecountry * rowsShowncountry;
            var endItemcountry = startItemcountry + rowsShowncountry;
            $('#country tbody tr').css('opacity', '0.0').hide().slice(startItemcountry, endItemcountry).css('display', 'table-row').animate({
                opacity: 1
            }, 300);
        }
    });
    $('#showcountry').bind('click', function() {
        if (rowsShowncountry != rowsTotalcountry) {
            currPagecountry = 0;
            rowsShowncountry = rowsTotalcountry;
            var startItemcountry = currPagecountry * rowsShowncountry;
            var endItemcountry = startItemcountry + rowsShowncountry;
            $('#country tbody tr').css('opacity', '0.0').hide().slice(startItemcountry, endItemcountry).css('display', 'table-row').animate({
                opacity: 1
            }, 300);
            $('#leftcountry').text('...');
            $('#centercountry').text('...');
            $('#rightcountry').text('...');
            $('#showcountry').text('paginate');
            $("#lileftcountry").addClass('disabled');
            $("#lirightcountry").addClass('disabled');
        } else {
            currPagecountry = 0;
            rowsShowncountry = originalRowsShowncountry;
            rowsTotalcountry = $('#country tbody tr').length;
            numPagescountry = Math.ceil(rowsTotalcountry / rowsShowncountry);
            if (numPagescountry > 1) {
                $('#leftcountry').text('previous');
                $('#centercountry').text((currPagecountry + 1) + '/' + numPagescountry);
                $('#rightcountry').text('next');
                $('#showcountry').text('show all');
            }
            $("#leftcountry").attr("disabled", "disabled");
            $("#lileftcountry").addClass('disabled');
            $("#rightcountry").removeAttr("disabled");
            $('#lirightcountry').removeClass('disabled');
            $('#country tbody tr').hide();
            $('#country tbody tr').slice(0, rowsShowncountry).show();
        }
    });
});