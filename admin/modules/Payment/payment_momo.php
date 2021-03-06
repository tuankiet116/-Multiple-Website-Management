<?
    require("inc_security.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <?= $load_header ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="../../../plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../resource/css/payment_momo.css">
    <link rel="stylesheet" href="../../resource/select_nice/css/nice-select.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../resource/select_nice/js/jquery.js"></script>
    <script src="../../resource/select_nice/js/jquery.nice-select.min.js" ></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="../../../plugins/select2/js/select2.min.js"></script>
    <script language="javascript" src="../../resource/js/helper/function.js"></script>
    <script language="javascript" src="../../resource/js/payment_momo.js"></script>
</head>
<body>
    <div class="loader-container"><div class="loader"></div></div>
    <div class="alert alert-warning alert-dismissible fade alert-message" role="alert">
        <h4 class="alert-heading"></h4>
        <div class="message">   
        </div>
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="title-searching container-fluid">
        <h3>T??m Ki???m</h3>
    </div>
    
    <div class="search-container container-fluid">
        <div class="select-container pick_website_container col-3">
            <div class="title_pick_website title">
                <h4><?=translate_text('Website')?>: </h4>
            </div>
            <div class="box">
                <select class="pick_website_select">
                </select>
            </div>
        </div>
        <div class=" col-3">
            <label for="searching"><?= translate_text('H??nh Th???c Thanh To??n')?></label>
            <select id="payment-method" class="form-group">
                <option value="#">All</option>
                <option value="2">Momo</option>
                <option value="1">Thanh To??n Sau Khi Nh???n(COD)</option>
            </select>
        </div>
        <div class=" col-2">
            <label for="searching"><?= translate_text('Tr???ng Th??i')?></label>
            <select id="payment-status" class=" form-group">
                <option value="#">All</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <div class="col-2 form-group button-search">
            <button id="search_button" class="btn btn-primary" type="button"><?= translate_text('T??m Ki???m')?></button>
            <button id="clear_button" class="btn btn-danger" type="button"><?= translate_text('X??a')?></button>
        </div>
    </div>
    <div class="container-fluid">
        <row>
            <div class="btn-add col-3">
                <button style="margin-left: 5%;" class="btn btn-primary" id="btn-add" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-plus"></i>
                    <p>Th??m m???i</p>
                </button>
            </div>
        </row>
        
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Th??m M???i Thanh to??n</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-model-add">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form-add">
                            <div class="row" style="align-items: center;">
                                <div class="select-container add pick_website_container col-6">
                                    <div class="title_pick_website title">
                                        <h4><?=translate_text('Ch???n Website')?>: </h4>
                                    </div>
                                    <div class="box">
                                        <select class="pick_website_select add">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="payment_method_add">Ch???n Ph????ng Th???c Thanh To??n</label>
                                    <select name="payment_method_add" id="payment_method_add">
                                        <option value="1">Thanh To??n Khi Nh???n H??ng (COD)</option>
                                        <option value="2">MoMo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="input-text">
                                <div class="form-group">
                                    <label for="payment_partner_code">Partner Code</label>
                                    <input type="text" class="form-control" id="payment_partner_code"  placeholder="Nh???p Partner Code" autocomplete="off" disabled>
                                </div>
                                
                                <div class="form-group">
                                    <label for="payment_access_key">Access Key</label>
                                    <input type="text" class="form-control" id="payment_access_key"  placeholder="Nh???p Access Key" autocomplete="off" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="payment_secret_key">Secret Key</label>
                                    <input type="text" class="form-control" id="payment_secret_key"  placeholder="Nh???p Secret Key" autocomplete="off" disabled>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-close-bottom">????ng</button>
                        <button type="button" class="btn btn-primary" id="btn-payment-add">Th??m M???i</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <hr>
    <div class="show-payment-container container-fluid">
        <div class="show-payment-container container-fluid">
            <div class="container-fluid title-show-payment">
                <h3><?= translate_text('Danh S??ch H??nh Th???c Thanh To??n')?></h3>
            </div>
            <table class = "table">
                <thead class="table-primary">
                    <tr >
                        <th scope="col" style="width: 30px; text-align: center">No</th>
                        <th scope="col" style="text-align: center;"><?= translate_text('Website')?></th>
                        <th scope="col" style="text-align: center;"><?= translate_text('H??nh Th???c Thanh To??n')?></th>
                        <th scope="col" style="width: 100px; text-align: center;"><?= translate_text('Partner Code')?></th>
                        <th scope="col" style="width: 100px; text-align: center;"><?= translate_text('Access Key')?></th>
                        <th scope="col" style="width: 100px; text-align: center;"><?= translate_text('Secret Key')?></th>
                        <th scope="col" style="text-align: center;"><?= translate_text('Tr???ng Th??i')?></th>
                        <th scope="col" style="text-align: center;"><?= translate_text('H??nh ?????ng')?></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</body>

