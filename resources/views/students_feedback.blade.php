@extends('layout/main')
@section('content')
  <h1 class="content--title">Vista general de <strong>{{$data['studentName']}}</strong></h1>
  
  <!-- homework summary -->
  <div class="row">
    <!-- top graphic summary -->
    <div class="col-sm-12">
      <div class="box-md-flashcard">
        <div class="row">
          <!-- top graph 1 -->
          <div class="col-sm-4">
            <h2 class="flashcard--title">PROMEDIO EN ESTE CURSO</h2>
            <canvas id="myChart" width="auto" height="auto"></canvas>
              
            <script>
            var ctx = document.getElementById("myChart").getContext('2d');
            var myDoughnutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [{{$data['studentAverage']}}, {{10 - $data['studentAverage']}}],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255,99,132,1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }],

                    // These labels appear in the legend and in the tooltips when hovering different arcs
                    labels: [
                        'Promedio',
                        'Diferencia'
                    ]
                }
            });
            </script>
            <br>
            <p class='text-center'>Desempeño <strong>{{$data['studentRiskTag']}}</strong></p>
          </div>
          <!-- ends graph 1 -->
          <!-- top graph 2 -->
          <div class="col-sm-4">
            <h2 class="flashcard--title">TAREAS CON ENVÍO</h2>
            <canvas id="myChart2" width="auto" height="auto"></canvas>
              
            <script>
            var ctx = document.getElementById("myChart2").getContext('2d');
            var myDoughnutChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    datasets: [{
                        data: [{{$data['numExercises']}}, {{$data['numCourseExercises'] - $data['numExercises']}}],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255,99,132,1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }],

                    // These labels appear in the legend and in the tooltips when hovering different arcs
                    labels: [
                        'Tareas con envío',
                        'Tareas sin envío'
                    ]
                }
            });
            </script>
          </div>
          <!-- ends graph 2 -->
          <!-- top graph 3 -->
          <div class="col-sm-4">
            <h2 class="flashcard--title">COMPILACIONES POR EJERCICIO</h2>
            <canvas id="myChart3" width="auto" height="auto"></canvas>
              
            <script>
            var ctx = document.getElementById("myChart3").getContext('2d');
            var myDoughnutChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    datasets: [{
                        label: 'Compilaciones',
                        data: [
                          {{$data['minAmountSubmissionInExercises']}},
                          {{$data['avgAmountSubmissionInExercises']}},
                          {{$data['maxAmountSubmissionInExercises']}},
                        ],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255,99,132,1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }],

                    labels: [
                        'Menor',
                        'Promedio',
                        'Mayor'
                    ]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
            </script>
          </div>
          <!-- ends graph 3 -->
        </div>
      </div>
    </div>
    <!-- ends top graphic summary -->
    
    <!-- homework summary -->
    <div class="col-sm-6">
      <div class="box-md-flashcard">
        <h2 class="flashcard--title">TAREAS EN CURSO</h2>
        <table class="table">
          <thead>
            <td>No.</td>
            <td>Ejercicio</td>
            <td>Puntos</td>
          </thead>
          <tbody>
          @foreach($data['exercises'] as $exercise)
            <tr>
              <td>#{{$exercise['id']}}</td>
              <td> <a href="{{ route('exercise_detail',[$current,$exercise['id']]) }}"> {{$exercise['name']}}</a></td>
              <td>{{$exercise['average_for_student']}}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <!-- ends homework summary -->
    
    <!-- topic summary -->
    <div class="col-sm-6">
      <div class="box-md-flashcard">
        <h2 class="flashcard--title">ÚLTIMAS COMPILACIONES</h2>
        <table class="table">
          <tbody>
          @foreach($data['submissions'] as $submission)
            <tr>
              <td>{{$submission['exercise_name']}}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <!-- ends topic summary -->
  </div>

  <!-- ends homework summary -->
@endsection