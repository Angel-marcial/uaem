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
            $ingresos = 10; 
            $salidas = 8;  
            $visitas = 2;
        @endphp

        @include('administradores.dashboard.cards', compact('ingresos', 'salidas', 'visitas'))

        <!-- Gráfica de Barras -->
        <div class="mb-5">
            <h3>Gráfica de Barras</h3>
            <canvas id="barChart"></canvas>
        </div>

        <!-- Gráfica de Pastel -->
        <div class="mb-5">
            <h3>Gráfica de Pastel</h3>
            <canvas id="pieChart"></canvas>
        </div>

    </div>
    

    <script>
        // Datos para ambas gráficas
        const labels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'];
        const dataBar = [12, 19, 3, 5, 2];
        const dataPie = [30, 15, 25, 20, 10];
    
        // Configuración de la Gráfica de Barras
        const barChart = new Chart(document.getElementById('barChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Ventas Mensuales',
                    data: dataBar,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
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
                labels: ['Producto A', 'Producto B', 'Producto C', 'Producto D', 'Producto E'],
                datasets: [{
                    data: dataPie,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            }
        });
    </script>



@endsection