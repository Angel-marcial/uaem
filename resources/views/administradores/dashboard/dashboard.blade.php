@extends('administradores.contenido')

@section('content')

    @if (session('status'))

    @if (!session('error'))
        <div id="divCerrar1" class="alert alert-danger">
            {{ session('status') }}

            <button type="button" class="cerrar"  id="cerrar1" onclick="cerrarMensaje()">X</button>
        </div>
    @else
        <div id="divCerrar2" class="alert alert-success">
            {{ session('status') }}

            <button type="button" class="cerrar"  id="cerrar2" onclick="cerrarMensaje2()">X</button>
        </div>
    @endif

    @else

        <div class="display:none;"></div>

    @endif

    <div class="margenes">

        @php
            $date = date('Y-m-d');
        @endphp

        <h1>Dashboard</h1>  

         @php
            $ingresos = $data['barData'][0];
            $salidas = $data['barData'][1];  
            $visitasArribadas = $data['barData'][2];
            $visitas = $data['barData'][3];
        @endphp

        @include('administradores.dashboard.cards', compact('ingresos', 'salidas', 'visitas'))

        <div class="card-vw"></div>

        <!-- Gráfica de Barras -->
        <div class="row">
            
            <div class="col-md-6">
                <div class="mb-5">
                    <h3>Ingresos </h3>
                    <canvas id="barChart"></canvas>
                </div>
            </div>
    
            <!-- Columna para la Gráfica de Pastel -->
            <div class="col-md-6">
                <div class="mb-5">
                    <h3>Ingresos</h3>
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>

    </div>

    
    <script>

        const labels = @json($data['labels']);
        const dataBar = @json($data['barData']);
        const dataPie = @json($data['pieData']);

        // Configuración de la Gráfica de Barras
        const barChart = new Chart(document.getElementById('barChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Ingresos',
                    data: dataBar,
                    backgroundColor: [
                        'rgba(150, 136, 27)',
                        'rgba(96, 134, 109)',
                        'rgba(248, 249, 253)',

                    ],
                    borderColor: [
                        'rgba(96, 134, 109)',
                        'rgba(150, 136, 27)',
                        'rgba(150, 136, 27)',

                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    
        // Configuración de la Gráfica de Pastel
        const pieChart = new Chart(document.getElementById('pieChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: ['Entrada', 'salida', 'Invitados que ingresaron'],
                datasets: [{
                    data: dataPie,
                    backgroundColor: [
                        'rgba(150, 136, 27)',
                        'rgba(96, 134, 109)',
                        'rgba(248, 249, 253)',

                    ],
                    borderColor: [
                        'rgba(96, 134, 109)',
                        'rgba(150, 136, 27)',
                        'rgba(150, 136, 27)',

                    ],
                    borderWidth: 1
                }]
            }
        });
    </script>



@endsection