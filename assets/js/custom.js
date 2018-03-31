$.fn.reset = function () {
    $(this).each (function() { this.reset(); });
}

function decision(message, url){
    if(confirm(message)) location.href = url;
}
function confirmSubmit(form, message) { 
    /*var agree=confirm(message);
    if (agree) {
        form.submit();
        return false;
    } else {
        return false;
    } */
    noty({
        width: 200,
        text: message,
        type: "confirm",
        dismissQueue: true,
        timeout: 4000,
        layout: "topCenter",
        buttons: [{
            addClass: 'btn btn-primary btn-xs',
            text: 'Si',
            onClick: function ($noty) {
                $noty.close();
                form.submit();
            }
        }, {
            addClass: 'btn btn-danger btn-xs',
            text: 'No',
            onClick: function ($noty) {
                $noty.close();
            }
        }]
    }); 
}

$.extend( $.fn.dataTable.defaults, {
    autoWidth: false,
    columnDefs: [{ 
        orderable: false,
        width: '100px'
    }],
    dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
    language: {
        search: '<span>Buscar:</span> _INPUT_',
        lengthMenu: '<span>Mostrar:</span> _MENU_',
        paginate: {'first': 'Primero', 'last': 'Último', 'next': 'Siguiente &rarr;', 'previous': '&larr; Anterior'},
        emptyTable:"No hay datos disponibles en la tabla",
        info:"Mostrando _START_ a _END_ de _TOTAL_ entradas",
        infoEmpty:"Mostrando 0 a 0 de 0 entradas",
        infoFiltered:"(filtrado de _MAX_ entradas totales)",
        infoPostFix:"",
        decimal:"",
        thousands:",",
        lengthMenu:"Mostrar _MENU_ entradas",
        loadingRecords:"Cargando...",
        processing:"Procesando...",
        searchPlaceholder:"",
        url:"",
        zeroRecords:"No se encontraron registros coincidentes"
    },
    drawCallback: function () {
        $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
    },
    preDrawCallback: function() {
        $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
    }
});

var tablaData = $('.datatable-basic').DataTable();

$('.tooltip-error').click(function (e) {
    e.preventDefault();
    var message = "¿Está realmente seguro(a) de eliminar este registro?";
    var form = $('#form-delete');
    var action = form.attr('action').replace('USER_ID', $(this).data('id'));
    var rowss =  $(this).parents('tr');
    noty({
        width: 200,
        text: message,
        type: "confirm",
        dismissQueue: true,
        timeout: 4000,
        layout: "topCenter",
        buttons: [{
            addClass: 'btn btn-primary btn-xs',
            text: 'Si',
            onClick: function ($noty) {
                $noty.close();
                $.post(action, form.serialize(), function(result) {
                    if (result.success) {
                        tablaData.row(rowss).remove().draw();
                        noty({
                            force: true,
                            text: result.msg,
                            type: 'success',
                            layout: "topCenter"
                        });
                    } 
                    //else 
                        //row.show();
                }, 'json');
            }
        }, {
            addClass: 'btn btn-danger btn-xs',
            text: 'No',
            onClick: function ($noty) {
                $noty.close();
            }
        }]
    });
});

$("#usuarioForm").validate({
    ignore: 'input[type=hidden], .select2-search__field', 
    errorClass: 'validation-error-label',
    successClass: 'validation-valid-label',
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    errorPlacement: function(error, element) {
        if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
            if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent().parent().parent() );
            }
            else {
                error.appendTo( element.parent().parent().parent().parent().parent() );
            }
        }
        else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
            error.appendTo( element.parent().parent().parent() );
        }
        else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
            error.appendTo( element.parent() );
        }
        else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
            error.appendTo( element.parent().parent() );
        }
        else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
            error.appendTo( element.parent().parent() );
        }
        else {
            error.insertAfter(element);
        }
    },
    validClass: "validation-valid-label",
    success: function(label) {
        label.addClass("validation-valid-label").text("Correcto.")
    },
    rules: {
        name: {
            required: true
        },
        email: {
            required: true,
            email: true
        },
        username: {
            required: true
        },
        rol: {
            required: true
        },
        password: {
            required: true,
            minlength: 6
        },
        repeatPassword: {
            required: true,
            equalTo: "#password"
        }
    },
    messages: {
        name: {
            required: "Ingrese un nombre y apellido"
        },
        email: {
            required: "Ingrese un emal",
            email: "Ingrese un email válido"
        },
        username: {
            required: "Ingrese un nombre de usuario"
        },
        rol: {
            required: "Seleccione un rol"
        },
        password: {
            required: "Ingrese una contraseña",
            minlength: "Ingrese una contraseña con al menos 6 caracteres"
        },
        repeatPassword: {
            required: "Confirme la contraseña ingresada",
            equalTo: "Ambas contraseñas deben ser iguales"
        }
    },
    submitHandler: function () {
        var token = $("input[name=_token]").val();
        var formData = new FormData($("form#usuarioForm")[0]);
        $.ajax({
            url:  $("form#usuarioForm").attr('action'),
            type: $("form#usuarioForm").attr('method'),
            headers: {'X-CSRF-TOKEN' : token},
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("button#usuarioSubmit").addClass('disabled');
                $("button#cancelar").addClass('disabled');
            },
            success:function(response){
                var action = '';
                var alertMessage = '';
                var count = 0;
                if(response.validations == false){
                    //alertMessage = "<b>Campos únicos:</b> <br>";
                    $.each(response.errors, function(index, value){
                        count++;
                        alertMessage+= count+". "+value+"<br>";
                    });
                    noty({
                        width: 200,
                        text: alertMessage,
                        type: "information",
                        dismissQueue: true,
                        timeout: 10000,
                        layout: "topRight",
                        buttons: false
                    });
                }
                else if(response.validations == true){
                    if($("button#usuarioSubmit").attr('data') == 1)
                        action = 'agregado';
                    else if($("button#usuarioSubmit").attr('data') == 0)
                        action = 'actualizado';
                    alertMessage = 'Usuario '+action+' satisfactoriamente';
                    noty({
                        width: 200,
                        text: alertMessage,
                        type: "success",
                        dismissQueue: true,
                        timeout: 4000,
                        layout: "topCenter",
                        buttons: false
                    });
                    if($("button#usuarioSubmit").attr('data') == 1){
                        $('form#usuarioForm').reset();
                        $(document).find('.validation-valid-label').remove();
                    }
                    else if($("button#usuarioSubmit").attr('data') == 0){
                        var imagenActual = $('#fotoActual').attr("src").split("/uploads/");
                        var ruta = imagenActual[0]+"/uploads/usuarios/"+response.photo;
                        $('#fotoActual').attr("src", ruta);
                        $('#fotoSidebar').attr("src", ruta);
                        $('#fotoNavbar').attr("src", ruta);
                        console.log(response);
                    }
                }
                $("button#usuarioSubmit").removeClass('disabled');
                $("button#cancelar").removeClass('disabled');
            }
        })
        return false;
    }
});

$("#formLogin").validate({
    ignore: 'input[type=hidden], .select2-search__field', 
    errorClass: 'validation-error-label',
    successClass: 'validation-valid-label',
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    errorPlacement: function(error, element) {
        if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
            if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent().parent().parent() );
            }
            else {
                error.appendTo( element.parent().parent().parent().parent().parent() );
            }
        }
        else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
            error.appendTo( element.parent().parent().parent() );
        }
        else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
            error.appendTo( element.parent() );
        }
        else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
            error.appendTo( element.parent().parent() );
        }
        else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
            error.appendTo( element.parent().parent() );
        }
        else {
            error.insertAfter(element);
        }
    },
    validClass: "validation-valid-label",
    success: function(label) {
        label.addClass("validation-valid-label").text("Correcto.")
    },
    rules: {
        username: {
            required: true
        },
        password: {
            required: true,
            minlength: 6
        }
    },
    messages: {
        username: {
            required: "Ingrese un nombre de usuario"
        },
        password: {
            required: "Ingrese una contraseña",
            minlength: "Debe ingresar al menos 6 caracteres"
        }
    },
    submitHandler: function () {
        var token = $("input[name=_token]").val();
        var formData = new FormData($("form#formLogin")[0]);
        $.ajax({
            url:  $("form#formLogin").attr('action'),
            type: $("form#formLogin").attr('method'),
            headers: {'X-CSRF-TOKEN' : token},
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("button#loginButton").addClass('disabled');
            },
            success:function(response){
                var alertMessage = 'Usuario o contraseña incorrectos';
                if(response.message == "error"){
                    noty({
                        width: 200,
                        text: alertMessage,
                        type: "error",
                        dismissQueue: true,
                        timeout: 4000,
                        layout: "topCenter",
                        buttons: false
                    });
                    $('button#loginButton').removeClass('disabled');
                } else{
                    window.location = 'http://'+window.location.host+"/cifundaudo";
                }
            }
        })
        return false;
    }
});

$("#clienteForm").validate({
    ignore: 'input[type=hidden], .select2-search__field', 
    errorClass: 'validation-error-label',
    successClass: 'validation-valid-label',
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    errorPlacement: function(error, element) {
        if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
            if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent().parent().parent() );
            }
            else {
                error.appendTo( element.parent().parent().parent().parent().parent() );
            }
        }
        else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
            error.appendTo( element.parent().parent().parent() );
        }
        else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
            error.appendTo( element.parent() );
        }
        else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
            error.appendTo( element.parent().parent() );
        }
        else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
            error.appendTo( element.parent().parent() );
        }
        else {
            error.insertAfter(element);
        }
    },
    validClass: "validation-valid-label",
    success: function(label) {
        label.addClass("validation-valid-label").text("Correcto.")
    },
    rules: {
        cedula: {
            required: true,
            number: true
        },
        tipoPersona: {
            required: true
        },
        nombres: {
            required: true
        },
        apellidos: {
            required: true
        },
        email: {
            required: true,
            email: true
        },
        telefono: {
            required: true
        }
    },
    messages: {
        cedula: {
            required: "Ingrese un número de cédula",
            number: "Ingrese solo números"
        },
        tipoPersona: {
            required: "Seleccione el tipo de persona"
        },
        nombres: {
            required: "Ingrese un nombre"
        },
        apellidos: {
            required: "Ingrese un apellido"
        },
        email: {
            required: "Ingrese un emal",
            email: "Ingrese un email válido"
        },
        telefono: {
            required: "Ingrese un número de teléfono"
        }
    },
    submitHandler: function () {
        var token = $("input[name=_token]").val();
        var formData = new FormData($("form#clienteForm")[0]);
        $.ajax({
            url:  $("form#clienteForm").attr('action'),
            type: $("form#clienteForm").attr('method'),
            headers: {'X-CSRF-TOKEN' : token},
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("button#clienteSubmit").addClass('disabled');
                $("button#cancelar").addClass('disabled');
            },
            success:function(response){
                var action = '';
                var alertMessage = '';
                var count = 0;
                if(response.validations == false){
                    //alertMessage = "<b>Campos únicos:</b> <br>";
                    $.each(response.errors, function(index, value){
                        count++;
                        alertMessage+= count+". "+value+"<br>";
                    });
                    noty({
                        width: 200,
                        text: alertMessage,
                        type: "information",
                        dismissQueue: true,
                        timeout: 10000,
                        layout: "topRight",
                        buttons: false
                    });
                }
                else if(response.validations == true){
                    if($("button#clienteSubmit").attr('data') == 1)
                        action = 'agregado';
                    else if($("button#clienteSubmit").attr('data') == 0)
                        action = 'actualizado';
                    alertMessage = 'Cliente '+action+' satisfactoriamente';
                    noty({
                        width: 200,
                        text: alertMessage,
                        type: "success",
                        dismissQueue: true,
                        timeout: 4000,
                        layout: "topCenter",
                        buttons: false
                    });
                    if($("button#clienteSubmit").attr('data') == 1){
                        $('form#clienteForm').reset();
                        $(document).find('.validation-valid-label').remove();
                    }
                }
                $("button#clienteSubmit").removeClass('disabled');
                $("button#cancelar").removeClass('disabled');
            }
        })
        return false;
    }
});

$("#cursoForm").validate({
    ignore: 'input[type=hidden], .select2-search__field', 
    errorClass: 'validation-error-label',
    successClass: 'validation-valid-label',
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    errorPlacement: function(error, element) {
        if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
            if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent().parent().parent() );
            }
            else {
                error.appendTo( element.parent().parent().parent().parent().parent() );
            }
        }
        else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
            error.appendTo( element.parent().parent().parent() );
        }
        else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
            error.appendTo( element.parent() );
        }
        else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
            error.appendTo( element.parent().parent() );
        }
        else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
            error.appendTo( element.parent().parent() );
        }
        else {
            error.insertAfter(element);
        }
    },
    validClass: "validation-valid-label",
    success: function(label) {
        label.addClass("validation-valid-label").text("Correcto.")
    },
    rules: {
        nombre: {
            required: true
        },
        tipo: {
            required: true
        },
        horas: {
            required: true,
            number: true
        },
        costo: {
            required: true,
            number: true
        },
        status: {
            required: true
        }
    },
    messages: {
        nombre: {
            required: "Ingrese un nombre"
        },
        tipo: {
            required: "Seleccione el tipo de curso"
        },
        horas: {
            required: "Ingrese el número de horas",
            number: "Ingrese solo números"
        },
        costo: {
            required: "Ingrese un monto",
            number: "Ingrese solo números"
        },
        status: {
            required: "Seleccione un estado"
        }
    },
    submitHandler: function () {
        var token = $("input[name=_token]").val();
        var formData = new FormData($("form#cursoForm")[0]);
        $.ajax({
            url:  $("form#cursoForm").attr('action'),
            type: $("form#cursoForm").attr('method'),
            headers: {'X-CSRF-TOKEN' : token},
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("button#cursoSubmit").addClass('disabled');
                $("button#cancelar").addClass('disabled');
            },
            success:function(response){
                var action = '';
                var alertMessage = '';
                var count = 0;
                if(response.validations == false){
                    //alertMessage = "<b>Campos únicos:</b> <br>";
                    $.each(response.errors, function(index, value){
                        count++;
                        alertMessage+= count+". "+value+"<br>";
                    });
                    noty({
                        width: 200,
                        text: alertMessage,
                        type: "information",
                        dismissQueue: true,
                        timeout: 10000,
                        layout: "topRight",
                        buttons: false
                    });
                }
                else if(response.validations == true){
                    if($("button#cursoSubmit").attr('data') == 1)
                        action = 'agregado';
                    else if($("button#cursoSubmit").attr('data') == 0)
                        action = 'actualizado';
                    alertMessage = 'Curso '+action+' satisfactoriamente';
                    noty({
                        width: 200,
                        text: alertMessage,
                        type: "success",
                        dismissQueue: true,
                        timeout: 4000,
                        layout: "topCenter",
                        buttons: false
                    });
                    if($("button#cursoSubmit").attr('data') == 1){
                        $('form#cursoForm').reset();
                        $(document).find('.validation-valid-label').remove();
                    }
                }
                $("button#cursoSubmit").removeClass('disabled');
                $("button#cancelar").removeClass('disabled');
            }
        })
        return false;
    }
});

$("#facturacionCursoForm").validate({
    ignore: 'input[type=hidden], .select2-search__field', 
    errorClass: 'validation-error-label',
    successClass: 'validation-valid-label',
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    errorPlacement: function(error, element) {
        if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
            if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent().parent().parent() );
            }
            else {
                error.appendTo( element.parent().parent().parent().parent().parent() );
            }
        }
        else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
            error.appendTo( element.parent().parent().parent() );
        }
        else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
            error.appendTo( element.parent() );
        }
        else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
            error.appendTo( element.parent().parent() );
        }
        else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
            error.appendTo( element.parent().parent() );
        }
        else {
            error.insertAfter(element);
        }
    },
    validClass: "validation-valid-label",
    success: function(label) {
        label.addClass("validation-valid-label").text("Correcto.")
    },
    rules: {
        cliente: {
            required: true
        }
    },
    messages: {
        cliente: {
            required: 'Seleccione un cliente'
        }
    },
    submitHandler: function () {
        var token = $("input[name=_token]").val();
        var formData = new FormData($("form#facturacionCursoForm")[0]);
        if($('#tablaCargaFamiliar').find("tr").length > 1){
            $.ajax({
                url:  $("form#facturacionCursoForm").attr('action'),
                type: $("form#facturacionCursoForm").attr('method'),
                headers: {'X-CSRF-TOKEN' : token},
                data: formData,
                processData: false,
                contentType: false,
                beforeSend:function(){
                    $("button#facturacionCursoSubmit").addClass('disabled');
                    $("button#cancelar").addClass('disabled');
                },
                success:function(response){
                    var action = '';
                    var alertMessage = '';
                    var count = 0;
                    if(response.validations == false){
                        //alertMessage = "<b>Campos únicos:</b> <br>";
                        $.each(response.errors, function(index, value){
                            count++;
                            alertMessage+= count+". "+value+"<br>";
                        });
                        noty({
                            width: 200,
                            text: alertMessage,
                            type: "information",
                            dismissQueue: true,
                            timeout: 10000,
                            layout: "topRight",
                            buttons: false
                        });
                    }
                    else if(response.validations == true){
                        if($("button#facturacionCursoSubmit").attr('data') == 1)
                            action = 'registrada';
                        else if($("button#facturacionCursoSubmit").attr('data') == 0)
                            action = 'actualizada';
                        alertMessage = 'Factura '+action+' satisfactoriamente';
                        noty({
                            width: 200,
                            text: alertMessage,
                            type: "success",
                            dismissQueue: true,
                            timeout: 4000,
                            layout: "topCenter",
                            buttons: false
                        });
                        if($("button#facturacionCursoSubmit").attr('data') == 1){
                            $('form#facturacionCursoForm').reset();
                            $("#cliente").select2("val", "");
                            $("#tablaCargaFamiliar tbody > tr").remove();
                            $(document).find('.validation-valid-label').remove();
                        }
                    }
                    $("button#facturacionCursoSubmit").removeClass('disabled');
                    $("button#cancelar").removeClass('disabled');
                }
            });
        }else{
            noty({
                width: 200,
                text: 'Debe ingresar al menos un curso.',
                type: "information",
                dismissQueue: true,
                timeout: 10000,
                layout: "topRight",
                buttons: false
            });
            $(document).find('.validation-valid-label').remove();
        }
            
        return false;
    }
});

$("#passwordForm").validate({
    ignore: 'input[type=hidden], .select2-search__field', 
    errorClass: 'validation-error-label',
    successClass: 'validation-valid-label',
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    errorPlacement: function(error, element) {
        if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
            if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent().parent().parent() );
            }
            else {
                error.appendTo( element.parent().parent().parent().parent().parent() );
            }
        }
        else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
            error.appendTo( element.parent().parent().parent() );
        }
        else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
            error.appendTo( element.parent() );
        }
        else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
            error.appendTo( element.parent().parent() );
        }
        else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
            error.appendTo( element.parent().parent() );
        }
        else {
            error.insertAfter(element);
        }
    },
    validClass: "validation-valid-label",
    success: function(label) {
        label.addClass("validation-valid-label").text("Correcto.")
    },
    rules: {
        password_actual: {
            required: true
        },
        password: {
            required: true,
            minlength: 6
        },
        password_confirmation: {
            required: true,
            equalTo: "#password"
        }
    },
    messages: {
        password_actual: {
            required: 'Ingrese su contraseña actual'
        },
        password: {
            required: "Ingrese su nueva contraseña",
            minlength: jQuery.validator.format("Debe ingresar al menos {0} caracteres")
        },
        password_confirmation: {
            required: 'Repita la nueva contraseña',
            equalTo: 'Las contraseñas deben de ser iguales'
        }
    },
    submitHandler: function () {
        var token = $("input[name=_token]").val();
        var formData = new FormData($("form#passwordForm")[0]);
        $.ajax({
            url:  $("form#passwordForm").attr('action'),
            type: $("form#passwordForm").attr('method'),
            headers: {'X-CSRF-TOKEN' : token},
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("button#passwordSubmit").addClass('disabled');
                $("button#cancelar").addClass('disabled');
            },
            success:function(response){
                var action = '';
                var alertMessage = '';
                var count = 0;
                if(response.message == "error"){
                    noty({
                        width: 200,
                        text: 'La contraseña acutal ingresada es incorrecta.',
                        type: "error",
                        dismissQueue: true,
                        timeout: 4000,
                        layout: "topCenter",
                        buttons: false
                    });
                }
                else if(response.message == "correcto"){
                    action = 'actualizada';
                    alertMessage = 'Contraseña '+action+' satisfactoriamente';
                    noty({
                        width: 200,
                        text: alertMessage,
                        type: "success",
                        dismissQueue: true,
                        timeout: 4000,
                        layout: "topCenter",
                        buttons: false
                    });
                    $('form#passwordForm').reset();
                    $(document).find('.validation-valid-label').remove();
                }
                $("button#passwordSubmit").removeClass('disabled');
                $("button#cancelar").removeClass('disabled');
            }
        })
        return false;
    }
});

function eliminarFila(fila){
    var monto = fila.parentNode.previousSibling.firstChild.value;
    fila.parentNode.parentNode.remove();
    var total = $('#total').val();
    var nuevoTotal = parseFloat(total) - parseFloat(monto);
    $('#total').val(numeral(nuevoTotal).format('0.00'));
}

function eliminarFilaEditar(fila){
    var monto = fila.parentNode.previousSibling.previousSibling.childNodes[1].value;
    fila.parentNode.parentNode.remove();
    var total = $('#total').val().replace(',', '.');
    var nuevoTotal = parseFloat(total) - parseFloat(monto);
    $('#total').val(numeral(nuevoTotal).format('0.00'));
}

function agregarValor(){
    var tabla       = document.getElementById("tablaCargaFamiliar").tBodies[0];
    var monto       = document.getElementById("monto").value;
    var curso       = document.getElementById("curso").value;
    var combo       = document.getElementById("curso");
    var selected    = combo.options[combo.selectedIndex].text;

    if(curso == ""){
        alert("Seleccione un curso");
    }
    else if(monto == ""){
        alert("Ingrese un monto");
    }
    else{
        var fila = tabla.insertRow(-1);
        var celda0 = fila.insertCell(0);
        var celda1 = fila.insertCell(1);
        var celda2 = fila.insertCell(2);

        celda0.innerHTML = '<input type="hidden" name="cursoA[]" id="cursoA[]" value="'+curso+'" />'+selected;
        celda1.innerHTML = '<input type="hidden" name="montoA[]" id="montoA[]" value="'+monto+'" />'+numeral(monto).format('0.00');
        celda2.innerHTML = '<button type="button" onclick="eliminarFila(this)" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>';
        var total = $('#total').val();
        var nuevoTotal = parseFloat(total) + parseFloat(monto);
        $('#total').val(numeral(nuevoTotal).format('0.00'));
        $('#curso').val('');
        document.getElementById("monto").value = "";
        $(document).find('.validation-valid-label').remove();
    }
}