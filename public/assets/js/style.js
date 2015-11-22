$(document).ready(function(){

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
    $('#isbn').autocomplete({
        source : '/searchtitle',
        minLength : 1,
        select: function(event, ui) {
            $('#isbn').val(ui.item.value);
        }
    });

    //Search Reader
    $('#readerTitle').autocomplete({
        source : '/search/reader',
        minLength : 1
    });

});

//Fetch Book details from the API
$('#isbn').blur(function(){
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
});

//Generate Modal based on Quantity entered
var accessionno=0,classno=0;
$('#generate').click(function(){
    $.ajax({
        method : 'GET',
        url : '/get/accession',
        success : function(response){
            var string = "";
            var quantity = $('#quantity').val();
            if(response.length == 0){
                for(var i=1;i<=quantity;i++){
                    string += '<div class=row><div class=col-md-6><div class=form-group><label for=accession'+i+'>Accession</label><input type=number class=form-control id=accession'+i+' name=accession'+i+' autocomplete=off></div></div><div class=col-md-6><div class=form-group><label for=classno'+i+'>Class</label><input type=number class=form-control id=classno'+i+' name=classno'+i+' autocomplete=off></div></div></div>';
                }   
            }
            else{
                accessionno = response[0].accession_no;
                classno = response[0].class_no;
                for(var i=1;i<=quantity;i++){
                    string += '<div class=row><div class=col-md-6><div>Last Accession No. '+accessionno+'</div><div class=form-group><label for=accession'+i+'>Accession</label><input type=number class=form-control id=accession'+i+' name=accession'+i+' value='+(accessionno+i)+' autocomplete=off></div></div><div class=col-md-6><div>Last Class No.'+classno+'</div><div class=form-group><label for=classno'+i+'>Class</label><input type=number class=form-control id=classno'+i+' name=classno'+i+' value='+(classno+i)+' autocomplete=off></div></div></div>';
                }
            }
            $('#generated').html(string);
            $('#myModal').modal({show:true,backdrop:false});
        },
        error : function(){
            alert('Something went wrong');
        }
    });
});

//Get Pending Issue Details on form submit
$('#pending').click(function(){
    var id = $('#readerid').val();
    if(id == ""){
        $('#response').html("The field is required");
        return;
    }
    $('#pending').prop('disabled',true);
    $.ajax({
        method : 'GET',
        url : '/pending/'+id,
        success : function(response){
            response = JSON.parse(response);
            if(response.status == 404){
                $('#response').html(response.message);
            }
            else{
                $('#pendingdata').append("<td>"+response.id+"</td><td>"+response.name+"</td><td>"+response.department+"</td><td>"+response.year+"</td><td>"+response.pending+"</td>");
                $('#table').append("<a class='btn btn-primary form-control' href=/publication/issue/"+response.id+">Proceed to Issue</a>");
                $('#table').css({"display":"block"});
                flag = 1;
            }
        },
        error : function(){
            alert('Something went wrong');
        }
    });
});

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
                alert('Something went wrong');
            }
        })
        },
        minLength : 1,
        select: function(event, ui) {
            event.preventDefault();
            $('#search').val(ui.item.value);
            var value = ui.item.value;
            window.location.href = '/search/book/'+value;
        }
    });
$('#firsttime').submit(function(){
    if($('#newpassword').val() != $('#confirmpassword').val()){
        $('#passwordmatcherror').html("They Do not Match");
    }
    else{
     $('#passwordmatcherror').html("");  
    }
});

//Disable submit in search
$('#searchform').submit(false);

$('#type').change(function(){
    if($('#type').val() == 'acquisition'){
        $.ajax({
            method : 'GET',
            url : '/get/vendor',
            success : function(response){
                var select = "<label for=vendor>Vendor</label><select class=form-control id=vendor name=vendor>"
                for(var i=0 ;i<response.length; i++){
                    select += "<option>"+response[i].name+"</option>";
                }
                select += "</select>";
                $('#vendor').append (select);
            },
            error : function(){
                alert('Something went wrong');
            }
        });
    }
});

$('#download').click(function(){
    $('#report').tableExport({type:'pdf',pdfFontSize:'10',escape:'false'});
});