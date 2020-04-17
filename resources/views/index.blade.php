@extends('layouts.app')
@section('content')
    <div class="card shadow-none">
        <div class="card-body">
            <div class="row">
                <div class="col-2 pl-0" id="st-img">
                    <div class="">
                        <img src="{{ asset('img/noimage.png')}}" alt="NoImg" style="width: 100px">
                    </div>
                </div>
                <div class="col-10 ">
                    <div class="st-name">
                        Hôpital nationale
                    </div>
                    <div>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        rro, quo quod repellendus rerum sapiente
                        totam unde voluptatibus? Alias.
                    </div>
                </div>

                {{--                <div class="col-4" id="st-description">--}}

                {{--                   --}}

                {{--                </div>--}}
            </div>
        </div>
        <div class="card-footer">
            <p class="card-text d-inline"><small class="text-muted">Last updated 3 mins ago</small>
            </p><a href="#" class="card-link float-right"><small>Card link</small></a>
        </div>
    </div>
@endsection
