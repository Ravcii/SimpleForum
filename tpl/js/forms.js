$(document).ready(function() {
    
    //Register form
    $("form[id=reg-modal-form]").submit(function(){ 
        var values = {}; 
		var modal = "#reg-modal" + " "; //Чтобы не забыть о пробеле
        $.each($("form[id=reg-modal-form]").serializeArray(), function(i, field) { 
            values[field.name] = field.value; 
        });
        $.ajax({ 
            type:"POST", 
            url: "/engine/actions.php?do=reg", 
            data: {"values": values}, 
            cache: false, 
            success:function(response) { 
                if (response == 1) {
					$("button[form=reg-modal-form]").attr("disabled", true);
					$(modal + "#message").removeClass("alert-error").addClass("alert-success").show().delay(1000);
					$(modal + "#message span").html("Ура, вы зарегестрировались! Сейчас вы будете перенаправлены.");					
					$(modal + "#message h4").html("Поздравляем!");					
                    window.setTimeout('window.location.reload()', 1000); 
                } else {
					$(modal + "#message").show().delay(1000);
					$(modal + "#message span").html(response);
				}
            } 
        }); 
        return false; 
    }); 
	
	//Login Form
    $("form[id=login-modal-form]").submit(function(){ 
        var values = {}; 
		var modal = "#login-modal" + " "; //Чтобы не забыть о пробеле
        $.each($("form[id=login-modal-form]").serializeArray(), function(i, field) { 
            values[field.name] = field.value; 
        });
        $.ajax({ 
            type:"POST", 
            url: "/engine/actions.php?do=login", 
            data: {"values": values}, 
            cache: false, 
            success:function(response) { 
                if (response == 1) {
					$("button[form=login-modal-form]").attr("disabled", true);
					$(modal + "#message").removeClass("alert-error").addClass("alert-success").show().delay(1000);
					$(modal + "#message span").html("Ура, вы вы вошли! Сейчас вы будете перенаправлены.");					
					$(modal + "#message h4").html("Поздравляем!");					
                    window.setTimeout('window.location.reload()', 1000); 
                } else {
					$(modal + "#message").show().delay(1000);
					$(modal + "#message span").html(response);
				}
            } 
        }); 
        return false; 
    }); 
	
	//Exit form
    $("li[name=login-exit]").click(function(){
        $.ajax({ 
            url: "/engine/actions.php?do=exit", 
            cache: false, 
            success:function(response) { 
                if (response == 1) {						
                    window.location.reload(); 
                }
            } 
        }); 
        return false; 
    }); 
	
	//Add order form
    $("form[id=add-order-form]").submit(function(){ 
        var values = {}; 
		var modal = "#add-order-form" + " "; //Чтобы не забыть о пробеле
        $.each($("form[id=add-order-form]").serializeArray(), function(i, field) { 
            values[field.name] = field.value; 
        });
        $.ajax({ 
            type:"POST", 
            url: "/engine/actions.php?do=add-order", 
            data: {"values": values}, 
            cache: false, 
            success:function(response) { 
                if (response == 1) {
					$("input[type=submit]").attr("disabled", true);
					$(modal + "#message").removeClass("alert-error").addClass("alert-success").show().delay(1000);
					$(modal + "#message span").html("Ваш заказ принят, и поставлен на обработку! Статус вы можете узнать во вкладке \"Ваши заказы\"<br>Сейчас вы будете перенаправлены.");					
					$(modal + "#message h4").html("Поздравляем!");					
                    setTimeout("document.location.href='/cabinet/orders'", 1500); 
                } else {
					$(modal + "#message").show().delay(1000);
					$(modal + "#message span").html(response);
				}
            } 
        }); 
        return false; 
    }); 
}); 