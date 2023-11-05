<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Details</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

       <!-- Favicon -->
       <link href="{{asset('img/favicon.ico')}}" rel="icon">

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
<link href="{{asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

<!-- Customized Bootstrap Stylesheet -->
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>

<body>





@include('components.nav-bar')



    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3"> Detail</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a class="text-white" href="/">Accueil</a></h6>
            <h6 class="text-body m-0 px-3">/</h6>
            <h6 class="text-uppercase text-body m-0">Detail</h6>
        </div>
    </div>
    <!-- Page Header Start -->


  <!-- Detail Start -->
  <div class="container-fluid pt-5">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-8 mb-5">
                    <h1 class="display-4 text-uppercase mb-5">{{$car->brand}}</h1>
                    <div class="row mx-n2 mb-3">
                        <div class="col-md-3 col-6 px-2 pb-2">
                            <img class="img-fluid w-100" src="{{asset('car_images/'.$car->picture1)}}" alt="">
                        </div>
                        <div class="col-md-3 col-6 px-2 pb-2">
                            <img class="img-fluid w-100" src="{{asset('car_images/'.$car->picture2)}}" alt="">
                        </div>
                        <div class="col-md-3 col-6 px-2 pb-2">
                            <img class="img-fluid w-100" src="{{asset('car_images/'.$car->picture3)}}" alt="">
                        </div>
                        <div class="col-md-3 col-6 px-2 pb-2">
                            <img class="img-fluid w-100" src="{{asset('car_images/'.$car->picture4)}}" alt="">
                        </div>
                    </div>
                    <p>{{$car->description}}</p>
                    <div class="row pt-2">
                        <div class="col-md-3 col-6 mb-2">
                            <i class="fa fa-car text-primary mr-2"></i>
                            <span>Model: {{$car->model}}</span>
                        </div>
                        <div class="col-md-3 col-6 mb-2">
                            <i class="fa fa-cogs text-primary mr-2"></i>
                            <span>{{$car->gearbox}}</span>
                        </div>
                        <div class="col-md-3 col-6 mb-2">
                            <i class="fa fa-road text-primary mr-2"></i>
                            <span>{{$car->mileage }}km</span>
                        </div>
                        <div class="col-md-3 col-6 mb-2">
                            <i class="fa fa-eye text-primary mr-2"></i>
                            @if ($car->gps==1)
                            <span  >
                                    GPS
                           </span>
                            @else
                           <span >
                                Pas de GPS
                           </span>
                           @endif
                        </div>

                        <div class="col-md-3 col-6 mb-2">
                            <i class="fa fa-tint text-primary mr-2"></i>
                            <span> {{$car->fuel_type}}</span>
                        </div>
                        <div class="col-md-3 col-6 mb-2">
                            <i class="fa fa-calendar text-primary mr-2"></i>
                            <span>{{$car->year_of_manufacture}}</span>
                        </div>
                        <div class="col-md-3 col-6 mb-2">
                            <i class="fa fa-user text-primary mr-2"></i>
                            <span>{{$car->number_place }}Personne</span>
                        </div>
                        <div class="col-md-3 col-6 mb-2">
                            <i class="fa fa-cart-plus text-primary mr-2"></i>
                            <span >
                                  Status:  {{$car->status}}
                           </span>

                        </div>







                    </div>
               </div>

                <div class="col-lg-4 mb-5">
                    <div class="bg-secondary p-5">
                        <h3 class="text-primary text-center mb-4">Reservation</h3>

                        <div class="form-group mb-0">
                           <a href="{{route('clbooking',['id'=>$car->id])}}" class="btn btn-warning btn-block"  style="height: 50px;"> Reserver</a>
                            <!-- <button class="btn btn-warning btn-block" type="submit" style="height: 50px;">Reserver</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Detail End -->


    <!-- Related Car Start -->
    <div class="container-fluid pb-5">
        <div class="container pb-5">
            <h2 class="mb-4">Related Cars</h2>
            <div class="owl-carousel related-carousel position-relative" style="padding: 0 30px;">
                @foreach ($cars as $c )


                <div class="rent-item">
                    <img class="img-fluid mb-4" src="{{asset('car_images/'.$c->picture1)}}" alt=""  height="50px">
                    <h4 class="text-uppercase mb-4">{{$c->brand}}</h4>
                    <div class="d-flex justify-content-center mb-4">
                        <div class="px-2">
                            <i class="fa fa-car text-primary mr-1"></i>
                            <span>{{$c->year_of_manufacture}}</span>
                        </div>
                        <div class="px-2 border-left border-right">
                            <i class="fa fa-cogs text-primary mr-1"></i>
                            <span>{{$c->model}}</span>
                        </div>
                        <div class="px-2">
                            <i class="fa fa-road text-primary mr-1"></i>
                            <span>{{$c->mileage}}</span>
                        </div>
                    </div>
                    <a class="btn btn-primary px-3" href="{{route('cardetail',['id'=>$car->id])}}">{{$c->rental_price_per_day}} FCFA/Jour</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Related Car End -->


   @include('components.bannerstart')


   @include('components.vendor')


   @include('components.footer')
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-warning btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('lib/tempusdominus/js/moment.min.js')}}"></script>
    <script src="{{asset('lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
    <script src="{{asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('js/main.js')}}"></script>
</body>

</html>
