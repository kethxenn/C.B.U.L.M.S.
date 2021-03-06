$(document).ready(function(){
	var table = $('#myTable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: urldata,
        columns: [
        {data: 'code',name: 'code', title: 'Contract Code', class: 'align-center'},
        {data: 'time_left',name: 'time_end', title: 'Grace Period', class: 'align-center'},
        {data: 'time_end',name: 'time_end', title: 'Ends on', class: 'align-center'},
        {data: 'type',name: 'code', title: 'Type', class: 'align-center'},
        {data: 'action', name: 'action', orderable: false, searchable: false, class :'align-center'},
        ]
    });
    $(".accordion").accordion({header: 'h3'});
    $("body").on("click", ".btnShowContractDetails", setModal);
    $("body").on("click", ".btnExtend", sendRequest);
});
function sendRequest(){
	var txt;
	var data=[];
	var check = false;
	var type = $(this).attr('data-type');
	var id = $(this).attr('data-id');
	if(type==='Renewal'){
		txt = "Input amount in years(Max 5 years): ";
	}else if(type==='Extension'){
		txt = "Input amount in months(Max 6 months): ";
	}
    var input = parseInt(prompt("Input amount you wish the contract to be increased by:\n"+txt)) ;
    if (input == null || input == "") {
    } else {
    	if(!isNaN(input)){
    		if(type==='Renewal'){
    			if(input<=5){
    				check = true;
    			}else{
    				alert('no it not fayn D:<');
    			}
	        }else if(type === 'Extension'){
	        	if(input<=6){
	        		check=true;
    			}else{
    				alert('no it not fayn D:<');
    			}
	        }
    	}   
    }
    data.push({name:'id',value:id});
    data.push({name:'duration',value:input});
    if(check){
    	$.ajax({
	    	url: urlPost,
	    	type: 'POST',
	    	data: $.param(data),
	    	success: function(data){
	    		console.log(data);
	    	},
	        error: function(xhr,textStatus,err)
	        {
	            console.log("readyState: " + xhr.readyState);
	            console.log("responseText: "+ xhr.responseText);
	            console.log("status: " + xhr.status);
	            console.log("text status: " + textStatus);
	            console.log("error: " + err);
	        }
	    });
    }
    
    
}

function setModal(){
    var header = "";
    var details = "";
    var content = "";
    var total_cost = "$";
    contract_id = $(this).attr('data-id');
    $.ajax({
        url: urlUnits + "/" + contract_id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {  
         $.each(data, function(key,value) {
            var type = (value.unit_type == 0)?'Raw':'Shell';
            content+="<h3>"+ value.unit_code +"</h3><div><b>Unit Type:</b>"+ type 
            +"<br><b>Floor #</b>"+value.unit_floorNum+"<br></div>";
            if(key==0){
                header += value.contract_code;
                details += "<br><b>Date Issued: </b>" + value.date_issued;
                details += "<br><b>Start of Contract: </b>" + value.start_date;
                details += "<br><b>End of Contract: </b>" + value.end_date;
                details += "<br><b>Approved by: </b>" + value.name;
                total_cost += value.total_cost;
            }
            });
         $("#header").html(header);
         $("#total_cost").html(total_cost);
         $("#contractDetailsTable").html(details);
         $("#unitsDetail").html(content);
         $(".accordion").accordion("refresh");
        },
        error: function(xhr,textStatus,err)
        {
            console.log("readyState: " + xhr.readyState);
            console.log("responseText: "+ xhr.responseText);
            console.log("status: " + xhr.status);
            console.log("text status: " + textStatus);
            console.log("error: " + err);
        }
    })
}