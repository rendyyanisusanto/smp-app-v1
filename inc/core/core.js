$(document).ready(function($) {
	
    if (window.location.hash.substr(1)!='') {
      set_content(window.location.hash.substr(1));
    }

    $(document.body).on('click', '.app-item', function(event) {
			// Pastikan elemen yang diklik adalah <a> dengan class 'app-item'
				if ($(event.target).closest('.app-item').length) {
						set_content($(this).attr('href'));
				}
				return false;
		});
    $(document.body).on('click', '#select_all' ,function(){
      if(this.checked){
        $('.checkbox').each(function(){
          this.checked = true;
        });
        }else{
        $('.checkbox').each(function(){
                    this.checked = false;
        });
        }
    });
        
    $(document.body).on('click', '.checkbox' ,function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
          $('#select_all').prop('checked',true);
        }else{
          $('#select_all').prop('checked',false);
        }
    });
    
    $(window).on('popstate', function(event) {
      
      set_content(window.location.hash.substr(1));
    });


});

function blockui(block)
{
    $(block).block({
            
            message: '<i class="icon-spinner4 spinner"></i>',
            overlayCSS: {
                backgroundColor: '#0E8F92',
                opacity: 0.9,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: 0,
                color: '#fff',
                backgroundColor: 'transparent'
            }
        });
}

function unblockui(block)
{
  $(block).unblock();
}
function set_content(url, data_send="")
{
		// $('#focus-set').get(0).focus();
		// $('.se-pre-con').css('display','block');
		var url_set=url;
					
		$.ajax({
			url: url_set,
			datatype:'html',
			type:'POST',
			data:data_send,
			success: function(result){
			
				// window.history.pushState(null,null, url_set);
				window.location.hash = url_set;
				// $(".se-pre-con").fadeOut("slow");
				$(".app-content").html(result);  
				
		}});
   
}

function send_ajax(url_get, data_get)
{
  return $.ajax({
    url : url_get,
    type: "POST",
    data: data_get,
    success: function () {
    },
    error: function (jXHR, textStatus, errorThrown) {
    }
    });
}

function send_ajax_file(url_get, data_get)
{
  return $.ajax({
    url : url_get,
    type: "POST",
    data: data_get,
    processData:false,
    contentType:false,
    cache:false,
    success: function () {
    },
    error: function (jXHR, textStatus, errorThrown) {
    }
    });
}

function noty(text, type)
{
  new Noty({
            text: 'You successfully read this important alert message.',
            type: 'success'
        }).show();
}

function random_string(lngt)
{
  var result = '';
  var chars = 'ABCDEFGHIJKLMNOPQRSTUVWQYZabcdefghijklmnopqrstuvwxyz1234567890';
  var chars_lgt = chars.length;
  for (var i = 0; i < chars_lgt; i++) {
    result += chars.charAt(Math.floor(Math.random()*chars_lgt));
  }
  return result;
}

function setting_table(table="",name="")
{
  send_ajax('Global_controller/get_table',{table:table,name:name}).then(function(data){
    var resp = JSON.parse(data);
    if (resp.trans_code != null) {
      
      $('.template_setting').val(resp.trans_code.value);
      $('.table').val(resp.table);
      $('.name').val(resp.name);
    }else{
      $('.template_setting').val("");
      $('.table').val(resp.table);
      $('.name').val(resp.name);
    }
    $('#setting_table').modal("toggle");
  })
}
function reload_table(table="",name="", class_frm=""){
  send_ajax('Global_controller/get_value',{table:table,name:name}).then(function(data){
    var resp = JSON.parse(data);

    $('.'+class_frm).val(resp.trans_code);
  })
}

$(document).on('submit','#app-submit-setting-table', function(e){
  e.stopImmediatePropagation();

  send_ajax($(this).attr('action'), $(this).serialize()).then(function(data){
    toastr.success('Data berhasil diinput, Tekan reset untuk mengubah');
    $('#setting_table').modal("toggle");
  });
  return false;
});
function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString();
      split       = number_string.split(','),
      sisa        = split[0].length % 3,
      rupiah        = split[0].substr(0, sisa),
      ribuan        = split[0].substr(sisa).match(/\d{3}/gi);
 
      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }
 
      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }



