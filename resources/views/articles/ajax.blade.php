@extends('layouts.app')

@section('content')
    <div class="row col-lg-5">
        <button type="button" class="btn btn-warning" id="getRequest">getRequest</button>
    </div>
    <div class="row col-lg-5">
        Register Form:
        <form id="register" action="#">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label for="firstname">First Name</label>
            <input type="text" id="firstname" class="form-control">

            <label for="lastname">First Name</label>
            <input type="text" id="lastname" class="form-control">

            <button type="submit" class="btn btn-primary">Register</button>
        </form>

    </div>
    <div id="getRequestData"></div>

    <div id="postRequestData"></div>
@stop