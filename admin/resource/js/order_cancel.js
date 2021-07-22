var base_url = "../../../";
$(document).ready(function () {
    $('#search_reason').niceSelect();
    getOrder("");
    searchTerm();
    clearTerm();
});

function getOrder(term){
    let data ={
        "term": term,
        "order_status": "3"
    }
    $.ajax({
        type: "POST",
        url: base_url+"api/Controller/getAllOrder.php",
        data: JSON.stringify(data),
        async: false,
        dataType: "JSON",
        success: function (res) {
            if(res.code == 200){
                var viewData = res.result.map(function(item, index){
                    let  order_payment ="";
                    let  order_reason = "";

                    if(item.order_payment == 1){
                        order_payment = `COD`;
                    }
                    else if(item.order_payment == 2){
                        order_payment = `MOMO`;
                    }
                    else{
                        order_payment = `Khác`;
                    }

                    if(item.order_reason == 1){
                        order_reason = "Admin Hủy";
                    }
                    else if(item.order_reason == 2){
                        order_reason = "Không Xác Nhận Được Với Khách Hàng";
                    } 
                    else if(item.order_reason == 3){
                        order_reason = "Khách Hàng Hủy Đơn Hoặc Trả Lại Hàng";
                    }

                    return`
                        <tr>
                            <th scope="row">${index + 1}</th>
                            <td>${item.order_id}</td>
                            <td>${item.product_name}</td>
                            <td>${item.user_name}</td>
                            <td>${order_payment}</td>
                            <td>${item.order_trans_id}</td>
                            <td>${item.web_name}</td>
                            <td>${order_reason}</td>
                            <td>
                                <button class="btn btn-primary btn-detail" order_id="${item.order_id}" data-toggle="modal" data-target="#show-modal-detail">Chi Tiết</button>
                            </td>
                        </tr>
                    `;
                })
            }
            else{
                var mes = `<tr style="background-color: white;">
                             <td colspan="9"><p style="color:red; text-align: center">${res?.message}</p></td>
                           </tr>`; 
            }

            $('.table > tbody').html(viewData ?? mes).ready(function(){
                getOrderById();
            });
        },
        error: function(res){
            console.log(res.responseText);
        }
    });
}

function getOrderById(){
    $('.btn-detail').click(function () { 
        let data = {
            "order_id": $(this).attr('order_id'),
            "order_status": "3"
        }
        order_id_g =  $(this).attr('order_id');
        $.ajax({
            type: "POSR",
            url: base_url+"api/Controller/getOrderById.php",
            data: JSON.stringify(data),
            dataType: "JSON",
            async:false,
            success: function (res) {
                // console.log(res);
                valueDetail(res);
            }
        });
        tooltip('#order_description', 30);
    });
    
}

function searchTerm(){
    $('#btn-search').click(function(){
        let term = $('#search_code').val();
        getOrder(term);
    })
}

function clearTerm(){
    $('#btn-cancel').click(function(){
        $('#search_code').val("");
        getOrder("");
    })
}

function valueDetail(data){
    let order_payment = '';
    let order_status ='';
    let order_reason = '';
    if(data.result.order_payment == 1){
        order_payment ='COD';
    }
    else if(data.result.order_payment == 2){
        order_payment ='MOMO';
    }
    else{
        order_payment ='Khác';
    }

    if(data.result.order_status == 3){
        order_status = 'Đơn Đã Hủy';
    }

    if(data.result.order_reason == 1){
        order_reason = 'Admin Hủy';
    }
    else if(data.result.order_reason == 2){
        order_reason = 'Không Xác Nhận Được Với Khách Hàng'
    }
    else if(data.result.order_reason == 3){
        order_reason = 'Khách Hàng Hủy Đơn Hoặc Trả Lại Hàng'
    }
    
    $('#order_id').text(data.result.order_id);
    $('#user_name').text(data.result.user_name);
    $('#product_name').text(data.result.product_name);
    $('#order_detail_quantity').text(data.result.order_detail_quantity);
    $('#order_payment_status').text(data.result.order_payment_status);
    $('#order_payment').text(order_payment);
    $('#web_name').text(data.result.web_name);
    $('#order_request_id').text(data.result.order_request_id);
    $('#order_trans_id').text(data.result.order_trans_id);
    $('#order_sum_price').text(data.result.order_sum_price);
    $('#order_paytype').text(data.result.order_paytype);
    $('#order_datetime').text(data.result.order_datetime);
    $('#order_status').text(order_status);
    $('#order_detail_unit_price').text(data.result.order_detail_unit_price);
    $('#order_detail_amount').text(data.result.order_detail_amount);
    $('#user_number_phone').text(data.result.user_number_phone);
    $('#user_email').text(data.result.user_email);
    $('#order_description').text(data.result.order_description);
    $('#order_reason').text(order_reason);
}

function tooltip(element, maxLength){
    let description = $(element);
    $.each(description, function () { 
        if($(this).text().length > maxLength){
        var stringOriginal = $(this).text();
        var subString = $(this).text().substring(0, maxLength) + '...';
        $(this).text(subString);
        $(this).attr('title', stringOriginal);
        }
    });
}

function showAlert(type, message){
    $('.alert').removeClass("alert-success");
    $('.alert').removeClass("alert-warning");
    $('.alert').removeClass("alert-danger");

    switch(String(type)){
        case "success":
        $('.alert').addClass('alert-success');
        $('.alert-heading').html('<i class="fas fa-check-circle"></i> Success!');
        break;
        case "error":
        $('.alert').addClass('alert-danger');
        $('.alert-heading').html('<i class="fas fa-exclamation-circle"></i> Error!');
        break;
        case "warning":
        $('.alert').addClass('alert-warning');
        $('.alert-heading').html('<i class="fa fa-warning"></i> Warning!');
        break;
    }

    $('.alert .message').html(message);
    $('.alert').addClass('d-block');
    setTimeout(function(){ $('.alert').removeClass('d-block'); }, 3000);

    $('.alert button.close').on('click', function(){
        $('.alert').removeClass('d-block');
    });
}