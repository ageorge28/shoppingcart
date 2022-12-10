@extends('admin.layouts.app')

@section('content')
              <div class="main-panel">
                <div class="content-wrapper">

            <div class="page-header">
                <h3 class="page-title">Dashboard</h3>
            </div>
                
              {{-- <script type="text/javascript">
                window.onload = function () {
                    var chart = new CanvasJS.Chart("chartContainer",
                    {
                      animationEnabled: true,
	                    theme: "light2",
                      title:{
                        text: "Orders"
                    },
                    axisX:{
                        title: "Date",
                        gridThickness: 2,
                      //  valueFormatString: "MMM"
                    },
                    axisY: {
                        title: "Order Value",
                     		valueFormatString: "₹#0"
                    },
                    data: [
                    {        
                        type: "spline",
                        lineColor: "rgb(75, 192, 192)",
                        markerColor: "rgb(75, 192, 192)",
                        xValueFormatString: "MMM DD, YYYY",
		                    yValueFormatString: "₹###.#",
                        dataPoints: [//array
                          @foreach($orders as $order)
                          {
                            x: new Date({{ Carbon\Carbon::parse($order->date)->format("Y") }}, {{ Carbon\Carbon::parse($order->date)->format("m") }}, {{ Carbon\Carbon::parse($order->date)->format("d") }}),
                            y: {{ $order->cart->total }}
                          },
                          @endforeach
                        ]
                    }
                    ]
                });
                
                    chart.render();
                }
                </script>
                <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

      
                    <div class="row">
                      <div class="col-xl-12 stretch-card grid-margin">
                        <div class="card">
                          <div class="card-body">
                            <div id="chartContainer" style="height:500px; width: 100%;">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>   --}}




                        <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
                        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.js"></script>
                        <style>
                            canvas {
                                -moz-user-select: none;
                                -webkit-user-select: none;
                                -ms-user-select: none;
                            }
                        </style>

<div class="row">
  <div class="col-xl-12 stretch-card grid-margin">
    <div class="card">
      <div class="card-body">
        <canvas id="canvas"></canvas>
      </div>
    </div>
  </div>
</div>  


                    <script>
                        var timeFormat = 'DD/MM/YYYY';
                    
                        var config = {
                            type:    'line',
                            data:    {
                                datasets: [
                                    {
                                        label: "Amount",
                                        data: [

                                          @foreach($orders as $order)
                                          {
                                            x: "{{ Carbon\Carbon::parse($order->date)->format("d/m/Y") }}",
                                            y: {{ $order->cart->total }}
                                          },
                                          @endforeach
                                        ],
                                        fill: false,
                                        borderColor: 'rgb(75, 192, 192)',
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                title:      {
                                    display: true,
                                    text:    "Orders"
                                },
                                scales:     {
                                    xAxes: [{
                                        type:       "time",
                                        time:       {
                                            format: timeFormat,
                                            tooltipFormat: 'll'
                                        },
                                        scaleLabel: {
                                            display:     true,
                                            labelString: 'Date'
                                        }
                                    }],
                                    yAxes: [{
                                        scaleLabel: {
                                            display:     true,
                                            labelString: 'Order Value'
                                        },
                                        ticks: {
                                          // Include a rupee sign in the ticks
                                          callback: function(value, index, values) {
                                              return '₹' + value;
                                          }
                                        }
                                    }],
                                },
                                tooltips: {
                                  callbacks: {
                                      label: function(tooltipItems, data) {
                                          return "₹" + tooltipItems.yLabel.toString();
                                      }
                                  }
                                }
                            }
                        };
                    
                        window.onload = function () {
                            var ctx       = document.getElementById("canvas").getContext("2d");
                            window.myLine = new Chart(ctx, config);
                        };
                    
                    </script>












                    <div class="row">
                      <div class="col-xl-4 grid-margin">
                        <div class="card stretch-card mb-3">
                          <div class="card-body d-flex flex-wrap justify-content-between">
                            <div>
                              <h4 class="font-weight-semibold mb-1 text-black"> Total Sales </h4>
                              {{-- <h6 class="text-muted">Average Weekly Profit</h6> --}}
                            </div>
                            <h3 class="text-success font-weight-bold">₹{{ $total }}</h3>
                          </div>
                        </div>
                        <div class="card stretch-card mb-3">
                          <div class="card-body d-flex flex-wrap justify-content-between">
                            <div>
                              <h4 class="font-weight-semibold mb-1 text-black"> Orders </h4>
                              {{-- <h6 class="text-muted">Weekly Customer Orders</h6> --}}
                            </div>
                            <h3 class="text-warning font-weight-bold">{{ $orders->count() }}</h3>
                          </div>
                        </div>
                        <div class="card mt-3">
                          <div class="card-body d-flex flex-wrap justify-content-between">
                            <div>
                              <h4 class="font-weight-semibold mb-1 text-black"> Products </h4>
                              {{-- <h6 class="text-muted">System bugs and issues</h6> --}}
                            </div>
                            <h3 class="text-primary font-weight-bold">{{ $products }}</h3>
                          </div>
                        </div>
                      </div>
                    </div>
           

  </div>
</div>
              
@endsection