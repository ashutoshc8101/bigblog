@extends('layouts.app')

@section('title'){{ $tag->name }}@endsection

@section('stylesheets')

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){


            $.ajax({
                type : 'GET',
                url : '/ajax/tag/blogs',
                data: "tag={{ $tag->slug  }}",
                success : function (data) {
                    $('.results').html(" ");
                    for(i=0; i< data.data.length; i++) {
                        $('.results').append("<li><a href='/" + data.data[i].slug +"'>" + data.data[i].title + "</a></li>");
                    }

                }
            });


            var lis = document.getElementsByClassName('tabs');
            $('.nav.nav-tabs li').click(function(event){
                event.preventDefault();
                for(i = 0; i<lis.length; i++){
                    $(lis[i]).removeClass('active');
                }
                var string = $(event.target).html();
                $.ajax({
                   type : 'GET',
                   url : '/ajax/tag/' + string.toLowerCase(),
                    data: "tag={{ $tag->slug  }}",
                   success : function (data) {
                       $('.results').html(" ");
                       for(i=0; i< data.data.length; i++) {
                           if(string === "Users") {
                               $('.results').append("<li><a href='/user/" + data.data[i].id + "'>" + data.data[i].name + "</a></li>");
                           }else if(string === "Blogs"){
                               $('.results').append("<li><a href='/" + data.data[i].slug +"'>" + data.data[i].title + "</a></li>");
                           }
                       }
                       $(event.target).parent('li').addClass('active');
                   }
                });


            });
        });
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                <div id="app">
                    <ul class="nav nav-tabs">
                        <li class="active tabs"><a href="#">Blogs</a></li>
                        <li class="tabs"><a href="#">Users</a></li>
                    </ul>
                    <div class="body">
                        <ul class="results">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection