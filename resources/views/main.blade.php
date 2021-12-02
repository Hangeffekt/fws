@extends('welcome')

@section("title", $Title)

@section("content")
@include("include.nav")
<div class="col-8">
    
    <div class="row">
        <div class="col-3 thead-dark">Név</div>
        <div class="col-3 thead-dark">Állapot</div>
        <div class="col-2 thead-dark">Kapcsolattartók száma</div>
        <div class="col-2 thead-dark"></div>
        <div class="col-2 thead-dark"></div>
        @each(include.table", $Projects, "project", "include.empty")
    </div>
</div>
<div class="col-4">
    <h3>Új projekt</h3>
    <form action="{{ route('createProject') }}" method="post" class="border border-primary rounded p-3">
        @csrf
        <div class="form-group">
            <label for="name">Cím</label>
            <input type="text" name="title" id="" class="form-control">
            <span class="text-danger">@error('title'){{ $message }} @enderror</span>
        </div>
        <div class="formg-roup">
            <label for="description">Leírás</label>
            <textarea name="description" id="" class="form-control"></textarea>
            <span class="text-danger">@error('description'){{ $message }} @enderror</span>
        </div>
        <div class="userbox">
            <h5>Új kapcsolat tartó</h5>
            <div class="form-group">
                <label for="name">Név</label>
                <input type="text" name="name" id="username" class="form-control">
                <span class="text-danger emptyname">A mező kitöltése kötelező</span>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="useremail" class="form-control">
                <span class="text-danger emptyemail">A mező kitöltése kötelező</span>
                <span class="text-danger">@error('contact'){{ $message }} @enderror</span>
            </div>
            <input type="hidden" name="modifyid" value="" id="modifyid">
            <p id="adduser" class="btn btn-success">Kapcsolattartó mentése</p>
            <p id="updateuser" class="btn btn-warning">Kapcsolattartó módosítása</p>
            <p id="clearform" class="btn btn-warning">Űrlap törlése</p>
        </div>
        <div class="col-12 alert alert-primary" role="alert" id="contactsalert">
            Még nincsenek kapcsolattartók!
        </div>
        <div class="contacts" id="contacts"></div>
        
        <button class="btn btn-success form-control">Projekt mentése</button>
    </form>
</div>

@endsection