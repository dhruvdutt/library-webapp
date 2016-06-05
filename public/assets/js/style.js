$(document).ready(function(){

    var vendor = 0,reader = 0;

    $('[data-submenu]').submenupicker();

     $('[data-toggle="popover"]').popover();

    $('#issuedatetimepicker').datetimepicker({
            format : 'YYYY-M-DD'
        });

    $('#returndatetimepicker').datetimepicker({
            format : 'YYYY-M-DD'
        });

    //Search Vendor
    $('#vendortitle').autocomplete({
        source : '/search/vendor',
        minLength : 1,
        select: function(event, ui) {
            $('#vendortitle').val(ui.item.value);
        }
    });

    //Search Book
    $('#title').autocomplete({
        source : '/search',
        minLength : 1,
        select: function(event, ui) {
            $('#title').val(ui.item.value);
        }
    });

    //Search Publication title based on isbn
    $('#publication_isbn').autocomplete({
        source : '/search/publication',
        minLength : 1
    });

    //Search Serial title based on issn,title,serial_no
    $('#issn').autocomplete({
        source : '/search/serial',
        minLength : 1
    });

    //Search Reader
    $('#readerTitle').autocomplete({
        source : '/search/reader',
        minLength : 1,
        select : function(event,ui){
          $("#readerTitle").val(ui.item.label);
        }
    });
  });

  //Search Reader
  $('#readerName').autocomplete({
      source : '/search/reader',
      minLength : 1,
      select : function(event,ui){
        $("#readerName").val(ui.item.value);
      }
  });

//Fetch Book details from the API
/*$('#isbn').blur(function(){
    var isbn = $('#isbn').val();
    $.ajax({
        method : 'GET',
        headers : 'Access-Control-Allow-Credentials: true',
        url : 'http://isbndb.com/api/v2/json/RWL4PKZ6/book/'+isbn,
        success : function(response){
                response = JSON.parse(response);
                $('#title').val(response.data[0].title);
                $('#publisher').val(response.data[0].publisher_name);
                $('#author').val(response.data[0].author_data[0].name);
        },
        error : function(){
                alert('Cannot get the information online.Please enter it manually');
        }
    });
});*/

//Search info based on title,publisher,author
$('#search').autocomplete({
        source : function(request,response){
         $.ajax({
            method : 'GET',
            url : '/search/'+$('#search').val()+'/query/'+$('#query').val(),
            success : function(data){
                response(JSON.parse(data));
            },
            error : function(){
                //alert('Something went wrong');
            }
        })
        },
        minLength : 1,
        select: function(event, ui) {
            event.preventDefault();
            $('#search').val(ui.item.value);
            var value = ui.item.value;
            window.location.href = '/search/book/'+value+'/query/'+$('#query').val();
        }
    });

//Disable submit in search
$('#searchform').submit(false);

$('#type').change(function(){
    $('#type').val() == 'publication_acquisition' || $('#type').val() == 'serial_acquisition'  ? vendor = 1 : vendor = 0;
    $('#type').val() == 'circulation_reader' || $('#type').val() == 'fine_reader' ? reader = 1 : reader = 0;

    vendor == 1 ? $('#vendor').css({'display':'block'}) : $('#vendor').css({'display':'none'});
    reader == 1 ? $('#reader').css({'display':'block'}) : $('#reader').css({'display':'none'});
});


$('#resetpassword').click(function(){
    if(confirm('Sure to reset password?')){
         return true;
    }
    return false;
});

$('#changepassword').click(function(){
  var newpassword = $('#newpassword').val();
  var confirmpassword = $('#confirmpassword').val();
  if(newpassword != confirmpassword){
    $('#error_message').html("They do not match");
    return false;
  }
  return true;
});

function download(title){
  $("#report").printMe({ "path": ["assets/css/bootstrap.min.css","assets/css/style.css"],"title": title,'img': ["assets/images/logo.png"] });
}

$(document).keydown(function(e){1!=e.ctrlKey||"61"!=e.which&&"107"!=e.which&&"173"!=e.which&&"109"!=e.which&&"187"!=e.which&&"189"!=e.which||e.preventDefault()}),$(window).bind("mousewheel DOMMouseScroll",function(e){1==e.ctrlKey&&e.preventDefault()});
