


$(document).ready(function (){
    var dataElement = $('[name="application"]');
    window.rootUrl = dataElement.data('root-url');
    window.csrfToken = dataElement.data('csrf-token');
	window.role = dataElement.data('role');
	
	initAjaxForms();
    initSubmitLinks();
    initSwitches();
	initPostLinks();
	
	Handlebars.registerHelper('loggedRole', window['loggedRole']);
    
    $("[required='required").siblings("label").each(function (){
        $(this).html($(this).html() + '*');
    })
	
	
});

function initAjaxForms(){
    $(".ajax-form").submit(function(event) {
        event.preventDefault();
        var action = $(this).attr('action');
        var enctype = $(this).attr('enctype');
        if(enctype === 'multipart/form-data'){
            var data = new FormData($(this)[0]);
        }
        else{
            var data = serializeFormToJSON(this);
        }
        var csrfToken = window.csrfToken;
        var onSuccess = window[$(this).data('success')];
        
        asyncRequest(action, data, csrfToken, enctype, onSuccess);
    });
}

function asyncRequest(action, data, csrfToken, enctype, onSuccess, method) {
    var contentType = "application/json";
    var dataType = 'json';
    
    if(enctype === 'multipart/form-data'){
        contentType = false;
        dataType = 'text';
    }
	
	method = method || "POST";

    $.ajax({
        type : method,
        contentType : contentType,
        url : action,
        data : data,
        dataType : dataType,
        timeout : 1000000,
        processData: false,
        cache: false,
        success : onSuccesCallback(onSuccess),
        error : function(e) {
            console.log("ERROR: ", e);
        },
        done : function(e) {
            console.log("DONE");
        }
    });
}

function onSuccesCallback(responseOk){
	return function(response, textStatus, jqXHR){
			if(response.success){
				responseOk(response.data);
			}
		};
}

function serializeFormToJSON(form){
    var dataForJson = {};
    var data = $(form).serializeArray();
    $.each(data, function () {
        if (dataForJson[this.name]) {
            if (!dataForJson[this.name].push) {
                dataForJson[this.name] = [dataForJson[this.name]];
            }
            dataForJson[this.name].push(this.value || '');
        } 
        else {
			dataForJson[this.name] = this.value || '';
        }
    });
	dataForJson._token = window.csrfToken;
    return JSON.stringify(dataForJson);
};

function initSubmitLinks(){
	$( ".submit-link" ).click(function (){
        var allowed = !$(this).data("prompt") || window[$(this).data("prompt")]();
        if(allowed){
            $("#" + $(this).data("form")).submit();
        }
    });
}

function initPostLinks(){
	$( ".post-button" ).click(function (){
        var allowed = !$(this).data("prompt") || window[$(this).data("prompt")]();
        if(allowed){
            var url = $(this).data("url");
			var onResponseOk = window[$(this).data("response-ok")];
			var method = $(this).data("method");
//			console.log($(this).data("data"));
			var data = $(this).data("data") || {};
			data._token = window.csrfToken;
			data = JSON.stringify(data);
			asyncRequest(url, data, window.csrfToken, null, onResponseOk, method);
        }
    });
}

/**
 * Inits hidden area switches
 * @returns {undefined}
 */
function initSwitches(){
//    $(".switch").each(function (){
//        var onText = $(this).data('on-text') ? $(this).data('on-text') : 'change';
//        $(this).html(onText);
//    }) 
    $(".switch").click(function() {
        switchInput(this);
    });
}

/**
 * Switches target area  - hidden/shown
 * @param dom element toggle - switch element
 */
function switchInput(toggle){
    var objectToSwitch = $("#" + $(toggle).data('target'));
    var offText = $(toggle).data('off-text') ? $(toggle).data('off-text') : 'storno';
    var onText = $(toggle).data('on-text') ? $(toggle).data('on-text') : 'change';
    $(objectToSwitch).toggleClass('hidden');
    if($(toggle).data('on')){
        $(toggle).html(onText);
        $(toggle).data('on', 0);
    }
    else{
        $(toggle).html(offText);
        $(toggle).data('on', 1);
    }
}

function loggedRole(role){
	return window.role <= role;
}