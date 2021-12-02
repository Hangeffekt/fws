<div id="{{ $project->id }}" class="col-12">
    <div class="row p-2 project-list">
        <div class="col-3">{{ $project->name }}</div>
        <div class="col-3">
            @foreach($Statuses as $status)
                @if($status->id == $project->status_id)
                    {{ $status->name }}
                @endif
            @endforeach
        </div>
        <div class="col-2">{{ count(json_decode($project->contacts)) }}</div>
        <div class="col-2"><a href="/project/{{ $project->id }}" class="btn btn-warning">Módosítás</a></div>
        <div class="col-2">
            <form class="deletproject">
                @csrf
                <input type="hidden" name="projectid" value="{{ $project->id }}" id="projectid">
                <button type="submit" class="btn btn-danger">Törlés</button>
            </form>
        </div>
    </div>
</div>