var submitButtonFormat = '<i class="checkmark icon"></i>Submit';
var nextButtonFormat = '<i class="angle double right icon"></i>Next';
var cancelButtonFormat = '<i class="remove icon"></i>Cancel';
var backButtonFormat = '<i class="angle double left icon"></i>Back';
var step = 1;
var max = 3;
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }
    })
    $("#test").click(function() {
        $('#modal').modal({
            closable: false,
            observeChanges: true
        }).modal('show').modal('refresh');
    });
    $('#btnNext').click(function(e) {
        e.preventDefault();
        handleStep(true);
        return false;
    })
    $('#btnBack').click(function() {
        handleStep(false);
        return false;
    })
    table = $('#table-units').DataTable({
        ajax: urlUnits,
        scrollCollapse: true,
        scrollY: '50vh',
        columns: [
            { data: 'description', name: 'description', title: 'Building', class: 'center aligned' },
            { data: 'floor_number', name: 'floor_number', title: 'Floor', class: 'center aligned' },
            { data: 'type', name: 'type', title: 'Unit Type', class: 'center aligned' },
            { data: 'size', name: 'size', title: 'Size', class: 'center aligned' },
            { data: 'price', name: 'price', title: 'Price', class: 'center aligned' },
            { data: 'action', orderable: false, searchable: false, class: 'center aligned',title:'Actions' }
        ]
    });
    $('#table-units tbody').on('click', '.button-details', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( formatdata(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
    $('#table-units tbody').on('click', '.button-add', function() {
        $(this).html('<i class="shop icon"></i>Deselect').removeClass('green').addClass('red');
        //var row = table.row( (this).closest('tr') );
        //table.cell(row, 5).data("B").draw();
        //console.log(row.data());
    });
    $('.dropdown').dropdown();
    $('#address-select')
        .dropdown({
            apiSettings: {
                // this url parses query server side and returns filtered results
                url: '//api.semantic-ui.com/tags/{query}'
            },
        });
    $('.ui.checkbox').checkbox();
    $('#form2').form({
        fields: {
            firstname: {
                identifier: 'first-name',
                rules: [{
                    type: 'empty',
                    prompt: 'Please enter your first name'
                }]
            },
            lastname: {
                identifier: 'last-name',
                rules: [{
                    type: 'empty',
                    prompt: 'Please enter your last name'
                }]
            },
            email: {
                identifier: 'email',
                rules: [{
                    type: 'email',
                    prompt: 'Please enter a valid email'
                }]
            },
            gender: {
                identifier: 'gender',
                rules: [{
                    type: 'empty',
                    prompt: 'Please select a gender'
                }]
            },
            address: {
                identifier: 'address',
                rules: [{
                    type: 'empty',
                    prompt: 'Please enter your address'
                }]
            },
            terms: {
                identifier: 'terms',
                rules: [{
                    type: 'checked',
                    prompt: 'You must agree to the terms and conditions'
                }]
            }
        }
    });
});
function formatdata ( d ) {
	    // `d` is the original data object for the row
	    // d.name
	    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
	        '<tr>'+
	            '<td>Full name:</td>'+
	            '<td>'+'test'+'</td>'+
	        '</tr>'+
	        '<tr>'+
	            '<td>Extension number:</td>'+
	            '<td>'+'test'+'</td>'+
	        '</tr>'+
	        '<tr>'+
	            '<td>Extra info:</td>'+
	            '<td>And any further details here (images etc)...</td>'+
	        '</tr>'+
	    '</table>';
	}
function handleStep(isForward) {
    if (step >= max && isForward) {
        //submit logic

    } else if (step == 1 && (!isForward)) {
        $('#modal').modal('hide');
    } else {
        var t = '#form' + step;
        if (isForward) {
            //check if form step is valid
            if ($(t).form('is valid')) {
                updateStepUI(true);
            } else {
                $(t).form('validate form');
            }
        } else {
            //$(t).form('reset');
            $('.ui.error.message').html('');
            updateStepUI(false);
        }

    }

    function updateStepUI(isForward) {
        if (isForward) {
            step++;
        } else {
            step--;
        }
        if (step == max) {
            document.getElementById('btnNext').innerHTML = submitButtonFormat;
        } else {
            document.getElementById('btnNext').innerHTML = nextButtonFormat;
        }
        if (step == 1) {
            document.getElementById('btnBack').innerHTML = cancelButtonFormat;
        } else {
            document.getElementById('btnBack').innerHTML = backButtonFormat;
        }
        //alert(step);
        for (var i = step - 1; i > 0; i--) {
            document.getElementById("step" + i).className = "completed step";
            document.getElementById("container" + i).style.display = "none";
        }
        for (var i = step + 1; i <= max; i++) {
            document.getElementById("step" + i).className = "step";
            document.getElementById("container" + i).style.display = "none";
        }
        document.getElementById("step" + step).className = "active step";
        document.getElementById("container" + step).style.display = "block";
    }
    

}