 <!-- Rent A Car Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <h1 class="display-1 text-warning text-center">03</h1>
            <h1 class="display-4 text-uppercase text-center mb-5">Find Your Car</h1>
            <div class="row">
                @foreach ($cars as $car)


                <div class="col-lg-4 col-md-6 mb-2">
                    <div class="rent-item mb-4">
                        <img class="img-fluid mb-4" src="{{asset('car_images/'.$car->picture1)}}" alt="">
                        <h4 class="text-uppercase mb-4">{{$car->brand}}</h4>
                        <div class="d-flex justify-content-center mb-4">
                            <div class="px-2">
                                <i class="fa fa-car text-warning mr-1"></i>
                                <span>{{$car->model}}</span>
                            </div>
                            <div class="px-2 border-left border-right">
                                <i class="fa fa-cogs text-warning mr-1"></i>
                                <span>{{$car->gearbox}}</span>
                            </div>
                            <div class="px-2">
                                <i class="fa fa-road text-warning mr-1"></i>
                                <span>{{$car->mileage}} KM</span>
                            </div>
                        </div>
                        <a class="btn btn-success px-3" href="{{route('cardetail',['id'=>$car->id])}}">{{$car->rental_price_per_day}} FCFA/Jour</a>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="d-flex justify-content-center">
    {!! $cars->links() !!}
</div>

        </div>
    </div>
    <!-- Rent A Car End -->
