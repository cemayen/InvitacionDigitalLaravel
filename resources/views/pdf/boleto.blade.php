<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Boleto - Familia {{ $nombreFamilia }}</title>
    <style>
        @page {
            size:  3356pt 1459pt;
            margin: 0;
        }
        @font-face {
            font-family: 'PlayfairMediumItalic';
            src: url('{{ public_path('fonts/PlayfairDisplay-MediumItalic.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        html, body {
            margin: 0;
            padding: 0;
        }
        body {
            background-color: #f5f3e2;
            font-family: Helvetica, Arial, sans-serif;
        }
        .bg-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        .texto-container {
            position: fixed;
            left: 2470pt;   /* X: ajusta cuando confirmes el valor */
            top: 820pt;
            font-family: 'PlayfairMediumItalic', sans-serif;
            width: 670pt;
            padding: 10pt
        }
        .nombre-familia {
            font-size: 60pt;
            color: #a07c57;
            margin: 0 0 6pt 0;
            font-weight: normal;
        }
        .nombres td {
            /* font-size: {{ $nombres->count() > 6 ? '10pt' : '12pt' }}; */
            font-size: 35pt;
            color: #5d5d5d;
            padding: 1pt 5pt 1pt 5pt;
            vertical-align: top;
        }
        .pases {
            font-size: 20pt;
            color: #5d5d5d;
            margin: 6pt 0 0 0;
        }
    </style>
</head>
<body>
    @if(!empty($imagenBase64))
        <img src="{{ $imagenBase64 }}" class="bg-image" alt="Boleto">
    @endif

    <div class="texto-container">
        {{-- <p class="nombre-familia">Familia {{ $nombreFamilia }}</p> --}}

        <table class="nombres" cellspacing="0" cellpadding="0" style="width: 100%" >
           
            @foreach($nombres as $nombre)
                <tr style="border-bottom: solid 1px #a07c57;">
                    <td class="numero" style="color: #a07c57; font-size:40pt">{{ $loop->iteration }}.</td>
                    <td class="name">{{ $nombre }}</td>
                </tr>
            @endforeach
           
        </table>

        {{-- <p class="pases">{{ $nombres->count() }} {{ $nombres->count() === 1 ? 'pase' : 'pases' }}</p> --}}
    </div>
</body>
</html>