@extends('asmoyo::admin.layout')

@section('structure')
	
	<div class="container-fluid asmoyo-container">
        <div class="row">
            <div class="col-md-1"> &nbsp; </div>

            <div class="col-md-11">

                <div class="row">
                    <div class="col-md-9">
                        <div class="content">
                            @section('content')
                            	{{$content}}
                            @show
                        </div>
                    </div>

                    <div class="col-md-3">
                        @section('sideRight')
                            
                        @show
                    </div>
                </div>

            </div>
        </div>
    </div>

@stop