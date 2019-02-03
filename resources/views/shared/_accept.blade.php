@can('accept',$answer)
    <a title="Mark this answer as best answer" class="{{$model->status}} mt-2"
        onclick="event.preventDefault();document.getElementById('accept-answer-{{$model->id}}').submit();">
        <svg class="fas fa-check fa-2x"></svg>
    </a>
    <form id="accept-answer-{{$model->id}}" action="{{route('answers.accept',$model->id)}}" method="POST" style="display:none;">
        @csrf
    </form>
@else
    @if($model->is_best)
        <a title="The question owner accepted this answer as best answer" class="{{$model->status}} mt-2">
            <svg class="fas fa-check fa-2x"></svg>
        </a>
    @endif
@endcan