function loadDashboard(){
    $('#pageContent').html('<img src="../images/waveball.gif" width="200" height="200">');
    showGraph();
    mode = 1;
    $.post("pages/main.php",
    {
     mode:mode,
    },
    function(data){
        // params = data.split("|");
        // if(params[0] == 'success'){
        //     document.getElementById('content').innerHTML = params[1];
        // }else{
        //     document.getElementById('content').innerHTML = params[1];
        // }
        $('#pageContent').html(data);
    });
}
function loadAbout(){
    hideGraph();
    $('#pageContent').html('<img src="../images/waveball.gif" width="200" height="200">');
    mode = 2;
    $.post("pages/emp_tbl.php",{mode:mode},function(data){
        $('#pageContent').html(data);
    });
  
}
function loadProduct(){
    hideGraph();
    $('#pageContent').html('<img src="../images/waveball.gif" width="200" height="200">');
    mode = 2;
    $.post("pages/prod_tbl.php",{mode:mode},function(data){
        $('#pageContent').html(data);
    });
  
}
function hideGraph(){
    $('#graph').addClass('hidden');
}
function loadCharges(){
    hideGraph();
    //$('#pageContent').html('<img src="../images/waveball.gif" width="200" height="200">');
    mode = 3;
    $.post("pages/charges_tbl.php",{mode:mode},function(data){
        $('#pageContent').html(data);
    });
}
function loadMonthlyCharges(){
    hideGraph();
    //$('#pageContent').html('<img src="../images/waveball.gif" width="200" height="200">');
    mode = 3;
    $.post("pages/charges_monthly_tbl.php",{mode:mode},function(data){
        $('#pageContent').html(data);
    });
}
function loadCostCharges(){
    hideGraph();
    //$('#pageContent').html('<img src="../images/waveball.gif" width="200" height="200">');
    mode = 3;
    $.post("pages/charges_cost_tbl.php",{mode:mode},function(data){
        $('#pageContent').html(data);
    });
}
function loadEmpCharges(){
    hideGraph();
    //$('#pageContent').html('<img src="../images/waveball.gif" width="200" height="200">');
    mode = 3;
    $.post("pages/charges_emp.php",{mode:mode},function(data){
        $('#pageContent').html(data);
    });
}

function updater(id, mode){
    //$('#pageContent').html('<img src="../images/waveball.gif" width="200" height="200">');
    $.post("pages/updater.php", {id:id, mode:mode}, function(data){
        loadCharges();
    });
}
function details(charges_id){
    //$('#pageContent').html('<img src="../images/waveball.gif" width="200" height="200">');
    $.post("pages/charges_details.php", {charges_id:charges_id}, function(data){
        $('#pageContent').html(data);
    });
}
function loadChargesSpecificBranch(){
    branch = document.getElementById('chbranch').value;
    emp = 0
    dates = $('#dates').val().split('|');
    $.post("pages/tblpages/charges_filter.php", {branch:branch, emp:emp, start:dates[0], end:dates[1]}, function(data){
        $('#charges').html(data);
    });
}
function loadChargesSpecificEmp(){
    branch = document.getElementById('chbranch').value;
    $.post("pages/tblpages/charges_filter_emp.php", {branch:branch}, function(data){
        $('#charges').html(data);
    });
}

function loadMonthlyChargesSpecific(){
    dates = $('#dates').val().split('|');
    $.post("pages/tblpages/charges_monthly_filter.php", {start:dates[0], end:dates[1]}, function(data){
        $('#monthly').html(data);
    });
}
function loadCostChargesSpecific(){
    branch = document.getElementById('chbranch').value;
    $.post("pages/tblpages/charges_cost_filter.php", {branch:branch}, function(data){
        $('#costly').html(data);
    });
}

