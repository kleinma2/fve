$(function(){
    $('.nav').on('click',function(){
        console.log('klik');
        var id=$(this).attr('data-id');
        console.log('nacti '+id);
        
        ajaxGet('structure/'+id+'/ajax',renderContent);
        history.pushState(null, null, 'structure/'+id);
        
        //omalovánky
        $('.nav').removeClass('w3-blue');
        $(this).addClass('w3-blue');
        
        if($('[data-parent='+id+']').is(':visible')){
            $(this).find($('.fa')).removeClass('fa-folder-open').addClass('fa-folder-o');
            $('[data-parent='+id+']').hide('fast'); 
        }else{
            $(this).find($('.fa')).removeClass('fa-folder-o').addClass('fa-folder-open');
            $('[data-parent='+id+']').show('fast');  
        }
    });
});

function unRoll(id){
     $('[data-id='+id+']').addClass('w3-blue');
     $('[data-id='+id+']').show('fast');
     //$('[data-id='+id+']').find($('.fa')).removeClass('fa-folder-o').addClass('fa-folder-open');
     
     el=$('[data-id='+id+']');
     while(el.length>0){
        if($(el).hasClass('hidden')){
            $(el).show('fast');    
        }
        el=$(el).parent();
    }
}

function w3_open() {
    if ($('#mySidenav').is(':visible')) {
        $('#mySidenav').hide();
        $('#myOverlay').hide();
    } else {
        $('#mySidenav').show();
        $('#myOverlay').show();
    }
}

function w3_close() {
    $('#mySidenav').hide();
    $('#myOverlay').hide();
}


function renderContent(data){
    $('#content').html(data);
}


function ajaxGet(url,callback){
    $.get({
        url: url,
        crossDomain: true
    }).done(function (data) {
        if(typeof callback == "function"){
            callback(data);
        }
    }).fail(function (err) {
        console.log(err);
    });
}
