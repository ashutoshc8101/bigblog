@extends('layouts.app')

@section('title')Profile @endsection

@section('content')

    <div class="col-md-10 col-md-offset-1">

    <div class="row-">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <img src="http://abcorthopedics.com/uploads/testimonials/dummy.jpg" width="100%" alt="{{ $user->name  }}" class="img-responsive img-circle" />
                    <h2 style="text-align: center">{{ $user->name  }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    Email: {{$user->email  }}
                    Blogs:
                        <ul>
                            @php
                                $i = 0;
                                foreach($user->blogs as $blog){
                                    echo "<li><a href='/" . $blog->slug . "'>" . $blog->title . "</a></li>";
                                    $i++;
                                    if($i === 5){
                                        break;
                                    }
                                }
                            @endphp
                        </ul>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
