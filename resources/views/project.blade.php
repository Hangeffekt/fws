@extends('welcome')

@section("title", $Title)

@section("content")
<div class="col-12">
    <form action="{{ route('updateProject') }}" method="post" class="col-4 m-auto">
        @csrf
        <div class="form-group">
            <label for="title">Név</label>
            <input type="text" name="title" id="" class="form-control" value="{{ $Project->name }}">
            <span class="text-danger">@error('title'){{ $message }} @enderror</span>
        </div>

        <div class="formg-roup">
            <label for="description">Leírás</label>
            <textarea name="description" id="" class="form-control">{{ $Project->description }}</textarea>
            <span class="text-danger">@error('description'){{ $message }} @enderror</span>
        </div>

        <div class="form-group">
            <label for="status">Státusz</label>
            <select name="status" class="form-control">
                @foreach($Statuses as $status)
                    <option value="{{ $status }}"
                        @if($status == $Project->status)
                            selected
                        @endif
                    >{{ $status }}</option>
                @endforeach
            </select>
            <span class="text-danger">@error('status'){{ $message }} @enderror</span>
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

        <div class="contacts" id="contacts">
            <?php $counter = 0;?>
            @foreach($Contacts as $contact)
                <?php $counter++;
                $contact_item = explode("/", $contact); ?>
                <div id='userrow{{ $counter }}'>
                    <div class='username'>{{ $contact_item[0] }}</div>
                    <div class='useremail'>{{ $contact_item[1] }}</div>
                    <div class="contact-buttons border-bottom border-dark">
                        <span class='modify btn btn-warning' id='modifyuser{{ $counter }}'>Szerkesztés</span>
                        <span class='deleteuser btn btn-danger' id='deleteuser{{ $counter }}'>Törlés</span>
                    </div>
                    <input type='hidden' name='contact[]' value='{{ $contact_item[0] }}/{{ $contact_item[1] }}'></div>
            @endforeach
        </div>
        
        <input type="hidden" name="id" value="{{ $Project->id }}">
        <button class="btn btn-success form-control">Projekt módosítása</button>
    </form>
</div>

<div class="col-12">
    <a href="/" class="btn btn-primary">Vissza</a>
</div>

@endsection