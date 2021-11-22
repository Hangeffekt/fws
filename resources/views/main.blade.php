@extends('welcome')

@section("title", $Title)

@section("content")
<div class="col-12">
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        Új projekt
    </button>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <form action="{{ route('createProject') }}" method="post" class="col-4 m-auto">
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
                    <input type="hidden" name="modifyid" value="">
                    <p id="adduser" class="btn btn-success">Kapcsolattartó mentése</p>
                    <p id="modifyuser" class="btn btn-warning">Kapcsolattartó módosítása</p>
                    <p id="clearform" class="btn btn-warning">Űrlap törlése</p>
                </div>
                <div class="col-12 alert alert-primary" role="alert" id="contactsalert">
                    Még nincsenek kapcsolattartók!
                </div>
                <div class="contacts" id="contacts"></div>
                
                <button class="btn btn-success form-control">Projekt mentése</button>
            </form>
        </div>
    </div>
</div>


    <div class="col-3">Név</div>
    <div class="col-3">Állapot</div>
    <div class="col-3"></div>
    <div class="col-3"></div>

    @if($Projects == null)
        <div class="col-12 alert alert-primary" role="alert">
            Még nincsenek projektek!
        </div>
    @else
        @foreach($Projects as $project)
        <div class="col-12">
            <div class="row">
                <div class="col-3">{{ $project->name }}</div>
                <div class="col-3">{{ $project->status }}</div>
                <div class="col-3"><a href="/project/{{ $project->id }}" class="btn btn-warning">Módosítás</a></div>
                <div class="col-3"><a href="" class="btn btn-danger">Törlés</a></div>
            </div>
        </div>
        @endforeach
        {{ $Projects->onEachSide(5)->links() }}
    @endif
@endsection