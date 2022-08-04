@extends('layouts.app')
@section('content')
@section('page')
    <div class="col-12 align-self-center">
        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Dashboard </h4>

    </div>
@endsection
<div class="container-fluid">
    <!-- ********************* -->
    <!-- Start First Cards -->
    <!-- ********************* -->
    <div class="card-group">
        <div class="card border-right">
            <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <div class="d-inline-flex align-items-center">
                            <h2 class="text-dark mb-1 font-weight-medium">
                                {{$memo}}
                            </h2>
                            <span
                                class="badge bg-primary font-12 text-white font-weight-medium badge-pill ml-2 d-lg-block d-md-none">Received</span>
                        </div>
                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Memo</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted"><i data-feather="file"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-right">
            <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">
                            {{$finished_memo}}
                        </h2>
                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Finished Memo
                        </h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted"><i data-feather="check-square"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-right">
            <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <div class="d-inline-flex align-items-center">
                            <h2 class="text-dark mb-1 font-weight-medium">
                                {{$total_complaints}}
                            </h2>
                            <span
                                class="badge bg-danger font-12 text-white font-weight-medium badge-pill ml-2 d-lg-block d-md-none">Received</span>
                        </div>
                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Complaint</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted"><i data-feather="inbox"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-right">
            <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">
                            {{$finished_complaints}}
                        </h2>
                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Finished Complaint
                        </h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted"><i data-feather="check-square"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div><div class="col-lg-12">

    <canvas id="myChart"></canvas>
    </div>


{{--
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="{{ asset('assets/images/rmh.png')}}" class="d-block w-75 m-auto" alt="1">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ asset('assets/images/rmh.png')}}" class="d-block w-75 m-auto " alt="2">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ asset('assets/images/rmh.png')}}" class="d-block w-75 m-auto" alt="3">
                  </div>
                </div>
                <button class="carousel-control-prev" style="background-color: Transparent;  border: none;"  type="button" data-target="#carouselExampleIndicators" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </button>
                <button class="carousel-control-next" style="background-color: Transparent;  border: none;"  type="button" data-target="#carouselExampleIndicators" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </button>
              </div> --}}
</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart').getContext('2d');

    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Blok A', 'Blok C'],
            datasets: [{

                label: 'Available',
                data: ['<?php echo $available_blokA; ?>', '<?php echo $available_blokC; ?>' ],
                backgroundColor: [

               "#5F76E8",
            //   "#FF4F70",

            ],
            borderColor: [

              "#1D7A46",
            //   "#CB252B",
            ],
            borderWidth: [1, 1]
            },
            {

                label: 'Booked',
                data: ['<?php echo $booked_blokA; ?>','<?php echo $booked_blokC; ?>' ],
                backgroundColor: [

            //    "#5F76E8",
               "#FF4F70",

            ],
            borderColor: [

            //   "#1D7A46",
              "#CB252B",
            ],
            borderWidth: [1, 1]
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
    </script>

    @endsection
