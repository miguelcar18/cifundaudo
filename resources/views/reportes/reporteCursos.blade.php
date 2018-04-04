<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Reporte de cursos</title>
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
                margin-top: 130px;
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
            div p {
                margin: 2;
            }
            .page-break {
                page-break-after: always;
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
            <div style="padding-top: 15px; text-align:center">
                <h3><b><u>{{ strtoupper($reporte) }}</u></b></h3>
                <p style="padding-top: -10px;"><b>@if($mes != 0) Mes:{{ $nombreMes }} @endif @if($anio != 0) Año: {{ $anio }} @endif</b></p>
            </div>
        </div>
        <div id="footer">
            <div class="page-number"></div>
        </div>
        
        <div>
            <table cellpadding="0" cellspacing="0" id="cabecera" border="0" width="100%" style="">
                <thead style="border-style: solid;">
                    <tr style="text-transform: uppercase;">
                        <th style="padding-left: 10px"><b>Nombre</b></th>
                        <th><b>Horas</b></th>
                        <th align="right"><b>Costo</b></th>
                        <th align="right" style="padding-right: 10px"><b>Estado</b></th>
                    </tr>
                </thead>
                <tbody>
                    @php ($total = 0)
                    @foreach($datos as $data)
                    <tr>
                        <td style="padding-left: 10px">{{  $data->nombre }}</td>
                        <td>{{ $data->horas }}</td>
                        <td align="right">{{ number_format($data->costo, 2, ',', '.') }}</td>
                        <td align="right" style="padding-right: 10px">
                            @if($data->status == 1)
                                Habilitado
                            @else
                                Deshabilitado
                            @endif
                        </td>
                    </tr>
                    @php ($total++)
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>