    $(document).ready(function(){
        total();
        getTotal();
    });
    $(".image-checkbox").each(function () {
        if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
            $(this).addClass('image-checkbox-checked');
        
        }
        else {
            $(this).removeClass('image-checkbox-checked');
        
        }
    
    });
    var id = [];
    var totalprice = [];
    // sync the state to the input
    $(".image-checkbox").on("click", function (e) {
        $(this).toggleClass('image-checkbox-checked');
        var $checkbox = $(this).find('input[type="checkbox"]');
        $checkbox.prop("checked",!$checkbox.prop("checked"))
        // getIDs();
       
        if( $('input[name="image[]"]:checked').length > 0){

            $("#next").prop('disabled', false); //disables the button

            if($checkbox.prop("checked") == false){
                $('input[name="image[]"]').each(function(){
                    remove(id, $(this).val());
                    clearHide($(this).val());
                });
            }
            $('input[name="image[]"]:checked').each(function(){
                // id = $(this).val();
                id.push($(this).val());
                show($(this).val());
            });
            

        }else{
            $("#next").prop('disabled', true);
            $('input[name="image[]"]').each(function(){
                remove(id, $(this).val());
                clearHide($(this).val());
            });
        }
        e.preventDefault();
    });
    
    function clearHide(id){
        $('#prodq-'+ id).addClass('hidden');
        $('#total-'+ id).addClass('hidden');
        $('#clear-'+ id).addClass('hidden');
        $('#values').addClass('hidden');
        $('#prodq-'+ id).val('');
        $('#total-'+ id).val('');
    }
    function show(id){
        $('#prodq-'+ id).removeClass('hidden'); //shows the textbox
        $('#total-'+ id).removeClass('hidden'); //shows the textbox
        $('#clear-'+ id).removeClass('hidden');
        $('#values').removeClass('hidden');
    }
    function total(){
        for(j=0; j<id.length; j++){
            var price = $('#price-'+id[j]).html();
            var quantity = $('#prodq-'+id[j]).val();
            var total = quantity * price;
            var str = null;
            if(isNaN(quantity)){
                alert("Must input a number!");
                $('#prodq-'+id[j]).val('');
            }else
            {
                $('#total-'+id[j]).val(total);
                    
                 if(checkOld(totalprice, id[j]) === true){
                      str = id[j]+"|"+total;
                       if(!totalprice.includes(str)){
                         totalprice.push(str);
                       }
                  }else{
                       str = id[j]+"|"+total;
                        if(!totalprice.includes(str)){
                           totalprice.push(str);
                        }
                  }
            }
        }
    }
    
    function getTotal(){
        var pdata;
        var gtotal = 0;
        for(i=0; i<totalprice.length; i++){
           pdata = totalprice[i].split("|");
           gtotal  = (gtotal + parseInt(pdata[1]));
        }
        document.getElementById('total').innerHTML = "Total: P"+gtotal;
        document.getElementById('totals').value=gtotal;
    }

    function checkEmpty(){
        if(document.getElementById('branches').value == null || document.getElementById('branches').value == ""){
            alert('Need to choose branch first before proceeding to the charges summary');
        }
    }
    function remove(arr, what) {
        var found = arr.indexOf(what);
    
        while (found !== -1) {
            arr.splice(found, 1);
            found = arr.indexOf(what);
        }
    }
    function checkOld(arr, id){
        flag = false;
        for(y=0; y<arr.length; y++){
            data = arr[y].split("|");
            oldstr = arr[y];
            if(id == data[0]){
                remove(arr, oldstr);
                flag = true;
                return flag;
            }else{
                return flag;
            }
        }
    }
