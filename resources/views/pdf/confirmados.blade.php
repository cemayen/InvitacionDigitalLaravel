<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Invitados Confirmados - Jennie & Cristian</title>
    <style>
        @page {
            margin: 35pt 30pt 40pt 30pt;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #4A4A4A;
            font-size: 10pt;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            background-color: #FFFFFF;
        }
        .header {
            text-align: center;
            border-bottom: 2pt solid #D8B690;
            padding-bottom: 12pt;
            margin-bottom: 14pt;
        }
        .subtitulo-boda {
            color: #92A68C;
            font-size: 9pt;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0 0 4pt 0;
            font-weight: bold;
        }
        .titulo-novios {
            color: #D8B690;
            font-size: 20pt;
            margin: 0 0 3pt 0;
            font-weight: bold;
        }
        .titulo-reporte {
            font-size: 13pt;
            color: #5C5C5C;
            margin: 0;
            font-weight: normal;
        }
        .fecha-emision {
            font-size: 8pt;
            color: #8C8C8C;
            margin-top: 5pt;
        }
        .resumen-cards {
            width: 100%;
            margin-bottom: 16pt;
        }
        .card-stat {
            background-color: #FDFCF8;
            border: 1pt solid #E7E3D8;
            border-radius: 6pt;
            padding: 8pt 10pt;
            text-align: center;
        }
        .card-stat-label {
            font-size: 7.5pt;
            text-transform: uppercase;
            color: #8C8C8C;
            font-weight: bold;
            letter-spacing: 0.5px;
        }
        .card-stat-value {
            font-size: 15pt;
            color: #D8B690;
            font-weight: bold;
            margin-top: 2pt;
        }
        .tabla-confirmados {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6pt;
        }
        .tabla-confirmados th {
            background-color: #92A68C;
            color: #FFFFFF;
            font-size: 8.5pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 7pt 6pt;
            text-align: left;
            border: 1pt solid #81957B;
        }
        .tabla-confirmados th.center,
        .tabla-confirmados td.center {
            text-align: center;
        }
        .tabla-confirmados td {
            padding: 6pt 6pt;
            font-size: 9pt;
            border: 1pt solid #E9E6DC;
            vertical-align: middle;
        }
        .fila-par {
            background-color: #FAF8F2;
        }
        .badge-cabana {
            display: inline-block;
            padding: 2pt 6pt;
            font-size: 7.5pt;
            font-weight: bold;
            border-radius: 4pt;
        }
        .badge-si {
            background-color: #E8EFE6;
            color: #496843;
            border: 1pt solid #C2D5BD;
        }
        .badge-no {
            background-color: #F1F1F1;
            color: #8C8C8C;
        }
        .badge-confirmado {
            color: #2F6F44;
            font-size: 7.5pt;
            font-weight: bold;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 8pt;
            color: #A0A0A0;
            border-top: 1pt solid #ECE8DD;
            padding-top: 5pt;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="subtitulo-boda">Nuestra Boda &bull; 01 de Mayo de 2027</div>
        <div class="titulo-novios">Jennie & Cristian</div>
        <div class="titulo-reporte">Lista de Invitados Confirmados</div>
        <div class="fecha-emision">Reporte generado el {{ now()->format('d/m/Y \a \l\a\s H:i') }} hrs</div>
    </div>

    <!-- Tarjetas de Resumen -->
    <table class="resumen-cards" cellpadding="0" cellspacing="6">
        <tr>
            <td width="33%" class="card-stat">
                <div class="card-stat-label">Familias con Confirmados</div>
                <div class="card-stat-value" style="color: #92A68C;">{{ $familias->count() }}</div>
            </td>
            <td width="33%" class="card-stat">
                <div class="card-stat-label">Total Invitados Confirmados</div>
                <div class="card-stat-value" style="color: #D8B690;">{{ $totalConfirmados }}</div>
            </td>
            <td width="33%" class="card-stat">
                <div class="card-stat-label">Familias con Cabaña</div>
                <div class="card-stat-value" style="color: #5C5C5C;">{{ $totalCabana }}</div>
            </td>
        </tr>
    </table>

    <!-- Tabla de Invitados -->
    <table class="tabla-confirmados">
        <thead>
            <tr>
                <th width="5%" class="center">#</th>
                <th width="32%">Familia</th>
                <th width="35%">Nombre del Invitado</th>
                <th width="12%" class="center">Cabaña</th>
                <th width="16%" class="center">Boletos Familia</th>
            </tr>
        </thead>
        <tbody>
            @php $contador = 1; @endphp
            @forelse($familias as $familia)
                @foreach($familia->invitados as $invitado)
                    @if(!empty(trim($invitado->nombre_completo ?? '')))
                        <tr class="{{ $contador % 2 == 0 ? 'fila-par' : '' }}">
                            <td class="center">{{ $contador++ }}</td>
                            <td>
                                <strong>{{ $familia->nombre_familia }}</strong>
                                <br>
                                <span style="font-size: 7.5pt; color: #8C8C8C;">Usuario: {{ $familia->username }}</span>
                            </td>
                            <td>
                                <span style="font-weight: 500;">{{ $invitado->nombre_completo }}</span>
                                <span class="badge-confirmado">&bull; Confirmado</span>
                            </td>
                            <td class="center">
                                @if($familia->opcion_cabana)
                                    <span class="badge-cabana badge-si">Sí</span>
                                @else
                                    <span class="badge-cabana badge-no">No</span>
                                @endif
                            </td>
                            <td class="center">
                                <strong>{{ $familia->cantidad_boletos }}</strong>
                                <span style="font-size: 7.5pt; color: #8C8C8C;">({{ $familia->invitados->where('confirmado', true)->count() }} activos)</span>
                            </td>
                        </tr>
                    @endif
                @endforeach
            @empty
                <tr>
                    <td colspan="5" class="center" style="padding: 18pt; color: #8C8C8C;">
                        Aún no hay invitados confirmados en el sistema.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Invitación Digital Jennie & Cristian &bull; Documento generado para control y logística del evento
    </div>
</body>
</html>
