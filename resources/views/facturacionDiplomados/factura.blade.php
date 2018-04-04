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
        </div>
        <div id="footer">
            <div class="page-number"></div>
        </div>
        <div style="float:left; margin-top: 40px; border-style: solid; padding-left: 4px; width:345px; height:150px">
            <p><b>Recibo a nombre de:</b></p>
            <p>Cliente: {{ $datos->nombreCliente->nombres.' '.$datos->nombreCliente->apellidos }}</p>
            <p>Cédula / RIF: {{ number_format($datos->nombreCliente->cedula, 0, '', '.') }}</p>
            <p>Teléfono(s): {{ $datos->nombreCliente->telefono }}</p>
            <p>Dirección: {{ $datos->nombreCliente->direccion }}</p>
            <p>Email: {{ $datos->nombreCliente->email }}</p>
        </div>
        <div style="float:right; margin-top: 40px; border-style: solid; padding-right: 4px; width:345px; height:150px">
            <h2 style="margin-top: 0px; text-align: right"><b>Recibo Nº: {{ 'D-'.$datos->id }}</b></h2>
            <p>Emisión: {{ date('d/m/Y') }}</p>
            <p>Vendedor: FUNDAUDO</p>
        </div>
        <div style="margin-top: 200px">
            <table cellpadding="0" cellspacing="0" id="cabecera" border="0" width="100%" style="padding-top: 20px;">
                <thead style="border-style: solid;">
                    <tr style="text-transform: uppercase;">
                        <th style="padding-left: 10px"><b>Código</b></th>
                        <th><b>Descripción</b></th>
                        <th align="right"><b>Cantidad</b></th>
                        <th align="right"><b>Precio</b></th>
                        <th align="right" style="padding-right: 10px"><b>Total</b></th>
                    </tr>
                </thead>
                <tbody style="padding-top: 100px">
                    <tr>
                        <td colspan="5"><br></td>
                    </tr>
                    @php ($total = $totalMonto = 0)
                    @foreach($cursos as $curso)
                    <tr>
                        <td style="padding-left: 10px">{{ $curso->curso }}</td>
                        <td>{{ $curso->nombreCurso->nombre }}</td>
                        <td align="right">1</td>
                        <td align="right">{{ number_format($curso->nombreCurso->costo, 2, ',', '.') }}</td>
                        <td align="right" style="padding-right: 10px">{{ number_format($curso->nombreCurso->costo, 2, ',', '.') }}</td>
                    </tr>
                    @php ($total = $total + $curso->nombreCurso->costo)
                    @php ($totalMonto = $totalMonto + $curso->monto)
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5"><br></td>
                    </tr>
                     <tr>
                        <td colspan="2" style="padding-left: 10px"><b>Total Cancelado:</b> {{ number_format($totalMonto, 2, ',', '.') }}</td>
                        <td colspan="3" align="right" style="padding-right: 10px"><u><h2 style="font-weight: bold;">Monto a Pagar: {{ number_format($total, 2, ',', '.') }}</h2></u></td>
                    </tr>
                    <tr>
                        <td colspan="5" style="height: 20px"><br></td>
                    </tr>
                    <tr>
                        <td colspan="5" align="justify">
                            Si el participante no utiliza el servicio correspondiente a la inscripción del curso oportunamente podrá realizarlo posteriormente siempre y cuando avise esta institución antes de iniciar el curso y/o diplomado, podrá utilizarlo en un lapso no mayor a tres meses de lo contrario no tendrá derecho a reclamos, salvo aquellos casos en los cuales se demuestre que fue incumplimiento de FUNDAUDO. El monto de la PRE-INSCRIPCION no tiene reembolso, el inicio del curso y/o diplomado es estrictamente al completar matrículas.
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-top: 60px" align="center">_______________________</td>
                        <td colspan="1" style="height: 20px"><br></td>
                        <td colspan="2" style="padding-top: 60px" align="center">_______________________</td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">FIRMA DEL PARTICIPANTE</td>
                        <td colspan="1"><br></td>
                        <td colspan="2" align="center">FUNDAUDO</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="page-break"></div>
        <div style="float:left; margin-top: 40px; border-style: solid; padding-left: 4px; width:345px; height:150px">
            <p><b>Recibo a nombre de:</b></p>
            <p>Cliente: {{ $datos->nombreCliente->nombres.' '.$datos->nombreCliente->apellidos }}</p>
            <p>Cédula / RIF: {{ number_format($datos->nombreCliente->cedula, 0, '', '.') }}</p>
            <p>Teléfono(s): {{ $datos->nombreCliente->telefono }}</p>
            <p>Dirección: {{ $datos->nombreCliente->direccion }}</p>
            <p>Email: {{ $datos->nombreCliente->email }}</p>
        </div>
        <div style="float:right; margin-top: 40px; border-style: solid; padding-right: 4px; width:345px; height:150px">
            <h2 style="margin-top: 0px; text-align: right"><b>Recibo Nº: {{ $datos->id }}</b></h2>
            <p>Emisión: {{ date('d/m/Y') }}</p>
            <p>Vendedor: FUNDAUDO</p>
        </div>
        <div style="margin-top: 200px">
            <table cellpadding="0" cellspacing="0" id="cabecera" border="0" width="100%" style="padding-top: 20px;">
                <thead style="border-style: solid;">
                    <tr style="text-transform: uppercase;">
                        <th style="padding-left: 10px"><b>Código</b></th>
                        <th><b>Descripción</b></th>
                        <th align="right"><b>Cantidad</b></th>
                        <th align="right"><b>Precio</b></th>
                        <th align="right" style="padding-right: 10px"><b>Total</b></th>
                    </tr>
                </thead>
                <tbody style="padding-top: 100px">
                    <tr>
                        <td colspan="5"><br></td>
                    </tr>
                    @php ($total = $totalMonto = 0)
                    @foreach($cursos as $curso)
                    <tr>
                        <td style="padding-left: 10px">{{ $curso->curso }}</td>
                        <td>{{ $curso->nombreCurso->nombre }}</td>
                        <td align="right">1</td>
                        <td align="right">{{ number_format($curso->nombreCurso->costo, 2, ',', '.') }}</td>
                        <td align="right" style="padding-right: 10px">{{ number_format($curso->nombreCurso->costo, 2, ',', '.') }}</td>
                    </tr>
                    @php ($total = $total + $curso->nombreCurso->costo)
                    @php ($totalMonto = $totalMonto + $curso->monto)
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5"><br></td>
                    </tr>
                     <tr>
                        <td colspan="2" style="padding-left: 10px"><b>Total Cancelado:</b> {{ number_format($totalMonto, 2, ',', '.') }}</td>
                        <td colspan="3" align="right" style="padding-right: 10px"><u><h2 style="font-weight: bold;">Monto a Pagar: {{ number_format($total, 2, ',', '.') }}</h2></u></td>
                    </tr>
                    <tr>
                        <td colspan="5" style="height: 20px"><br></td>
                    </tr>
                    <tr>
                        <td colspan="5" align="justify">
                            Si el participante no utiliza el servicio correspondiente a la inscripción del curso oportunamente podrá realizarlo posteriormente siempre y cuando avise esta institución antes de iniciar el curso y/o diplomado, podrá utilizarlo en un lapso no mayor a tres meses de lo contrario no tendrá derecho a reclamos, salvo aquellos casos en los cuales se demuestre que fue incumplimiento de FUNDAUDO. El monto de la PRE-INSCRIPCION no tiene reembolso, el inicio del curso y/o diplomado es estrictamente al completar matrículas.
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-top: 60px" align="center">_______________________</td>
                        <td colspan="1" style="height: 20px"><br></td>
                        <td colspan="2" style="padding-top: 60px" align="center">_______________________</td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">FIRMA DEL PARTICIPANTE</td>
                        <td colspan="1"><br></td>
                        <td colspan="2" align="center">FUNDAUDO</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </body>
</html>