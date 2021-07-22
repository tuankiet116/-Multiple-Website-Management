// JavaScript Document
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) {if (val.title!="") {nm=val.title;} else {nm=val.name;} if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- "'+nm+'" phải là một địa chỉ email.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- "'+nm+'" phải là một số.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- "'+nm+'" phải là số nằm giữa '+min+' và '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- Bạn chưa nhập "'+nm+'".\n'; }
  } if (errors) alert('Có những lỗi sau:\n'+errors);
  document.MM_returnValue = (errors == '');
}

function trim(sString)
{
	while (sString.substring(0,1) == ' ')
	{
	sString = sString.substring(1, sString.length);
	}
	while (sString.substring(sString.length-1, sString.length) == ' ')
	{
	sString = sString.substring(0,sString.length-1);
	}
	return sString;
}
function checkblank(str)
{
	if (trim(str)=='')
		return true;
	else
		return false;
}
function ValidateForm(formobj)
{
	if (checkblank(formobj.pro_name.value)) { alert('Please enter the title!'); return false;}

	formobj.submit();
}
function checkAll(){
	if($('#check-all').attr('checked')==true){
		$('.item-element').attr('checked',true);
	}else{
		$('.item-element').attr('checked',false);
	}
}
function check_edit(idobj){
		document.getElementById(idobj).checked = true;
}
function loadactive(obj){
	obj.innerHTML = '<img src="../../resource/images/grid/indicator.gif" />';
	//document.write((obj.innerHTML)); return false;
	$(obj).load(obj.href + '&ajax=1');
	return false;
}
function creat_link(object){
	window.open("../../resource/link/selected.php?object=" + object, "","height=600,width=700,menubar=0,resizable=1,scrollbars=1,statusbar=0,titlebar=0,toolbar=0");
}
function more_picture(type, temp){
	url = (type == "add") ? "more_picture.php?type=add&temp=" + temp : "more_picture.php?type=edit&temp_id=" + temp;
	window.open(url, "", "height=600,width=700,menubar=0,resizable=1,scrollbars=1,statusbar=0,titlebar=0,toolbar=0");
}

function changePriceText(id, value){
	formatCurrency(id, value);
	if(parseInt(value) > 0) $("#" + id).css("display", "inline-block");
	else $("#" + id).css("display", "none");
}

function formatCurrency(div_id, str_number){
	document.getElementById(div_id).innerHTML = addCommas(str_number);
}
function addCommas(nStr){
	nStr += ''; x = nStr.split(',');	x1 = x[0]; x2 = ""; x2 = x.length > 1 ? ',' + x[1] : ''; var rgx = /(\d+)(\d{3})/; while (rgx.test(x1)) { x1 = x1.replace(rgx, '$1' + '.' + '$2'); } return x1 + x2;
}

function searchKeyword(){
	keyvalue = document.getElementById("keyword").value;
	$.post('search.php', { keyword:  keyvalue}, function(data) {
	  $('#show_result').html(data);
	});
}

function searchPhacode(){
	keyvalue	=	document.getElementById("pha_code").value;
	if(keyvalue == ""){
		return false;
	}
	$.post('search_code.php', { pha_code: keyvalue}, function(data) {
		$('#show_result').html(data);
	});
}
function searchPhagia(){
	record_id	= document.getElementById("record_id").value;
	pha_id		= document.getElementById("pha_id").value;
	keyword		= document.getElementById("keyword").value;
	$.post('search_phagia.php', {pha_id : pha_id, record_id : record_id, keyword : keyword}, function(data) {
		$('#show_result').html(data);
	});
}

function list_deal(bus_id, i) {
   $.post('list_deal.php', { bus_id : bus_id}, function(data) {
	  $('#show_deal').html(data);
	});
}

function count_char(length) {

   a = 100 - parseInt(length);
   $("#count").html('Bạn còn <font color=red>' + a + '</font> ký tự');
}