<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Factura</title>
        <link href="{{ asset('assets/images/favicon.ico') }}" rel="shortcut icon">
        <link rel="stylesheet" href="{{ asset('css/pdf.css') }}">
        <style>
            @page { margin: 180px 50px; }
            #header {
                position: fixed; 
                left: 0px; 
                top: -180px; 
                right: 0px; 
                height: 150px; 
                text-align: center;
            }
            #footer {
                position: fixed; 
                left: 0px; 
                bottom: -180px; 
                right: 0px; 
                height: 150px; 
            }
            #footer .page:after {
                content: counter(page, upper-roman);
            }
            p.titulo {
                margin: 0;
            }
        </style>
    </head>
    <body marginwidth="0" marginheight="0">
        <div id="header">
            <br>
            <div style="text-align:center">
                <img src="{{ asset('assets/images/logo_udo.png') }}" width="100px" height="auto">
            </div>
            <div style="text-align:center">
                <p class="titulo"><b>FUNDAUDO MONAGAS</b></p>
                <p class="titulo"><b>RIF: J-40020905-6</b></p>
                <p class="titulo"><b>Av. Las Palmeras Edif. Don Pedro PB local 2. Telef: 0291-6412409. Maturín-Edo.Monagas</b></p>
                <p class="titulo"><b><u>Email: fundaudomonagas@gmail.com</u></b></p>
            </div>
        </div>
        <div id="footer">
            <div class="page-number"></div>
        </div>
        <div style="float:left; margin-top: 40px; border-style: solid; padding-left: 4px" width="40%">
            <p><b>Recibo a nombre de:</b></p>
            <p>Cliente: {{ $datos->id }}</p>
            <p>Cédula / RIF:</p>
            <p>Teléfono(s):</p>
            <p>Dirección:</p>
            <p>Email:</p>
        </div>
        <div style="float:right; margin-top: 40px; border-style: solid;" width="40%">
            <img src="{{ asset('assets/images/logo_udo.png') }}" width="100px" height="auto" style="margin: 0.5em;">
        </div>
        {{--
        <table cellpadding="0" cellspacing="0" id="cabecera" border="0" width="100%" style="padding-top: 20px;">
            <thead>
                <tr style="color:red; text-transform: uppercase">
                    <th><u>Cédula</u></th>
                    <th><u>Nombres</u></th>
                    <th><u>Apellidos</u></th>
                    <th><u>1era. Disciplina</u></th>
                    <th><u>2da. Disciplina</u></th>
                </tr>
            </thead>
            <tbody style="padding-top: 100px">
                <tr>
                    <td colspan="5"><br></td>
                </tr>
                @foreach($atletas as $atleta)
                <tr>
                    <td>{{ number_format($atleta->cedula, 0, '', '.') }}</td>
                    <td>{{ $atleta->nombre }}</td>
                    <td>{{ $atleta->apellido }}</td>
                    <td>{{ $atleta->disciplinaNombreUno }}</td>
                    <td>{{ $atleta->disciplinaNombreDos }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        --}}
    </body>
</html>