<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{$answersCount . " " . str_plural('Answer',$answersCount)}}</h2>
                </div>
                <hr>
                @include('layouts._messages')
                @foreach($answers as $answer)
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a title="This answer is useful" class="vote-up">
                                <svg class="fas fa-caret-up fa-3x"></svg>
                            </a>
                            <span class="votes-count">123</span>
                            <a title="This answer is not useful" class="vote-down off">
                                <svg class="fas fa-caret-down fa-3x"></svg>
                            </a>
                            <a title="Mark this answer as best answer" class="vote-accepted mt-2">
                                <svg class="fas fa-check fa-2x"></svg>
                            </a>
                        </div>
                        <div class="media-body">
                            {!!$answer->body_html!!}
                            <div class="row">
                                <div class="col-4">
                                    @can('update',$answer)
                                        <a href="{{route('questions.answers.edit',[$question->id,$answer->id])}}" class="btn btn-outline-info btn-sm">Edit</a>
                                    @endcan
                                    @can('delete',$answer)
                                        <form method="post" class="form-delete" action="{{route('questions.answers.destroy',[$question->id,$answer->id])}}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    @endcan
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <span class="text-muted">Answered {{$answer->created_date}}</span>
                                    <div class="media mt-2">
                                        <a href="{{$answer->user->url}}" class="pr-2">
                                            <img src="{{$answer->user->avatar}}">
                                        </a>
                                        <div class="media-body mt-1">
                                            <a href="{{$answer->user->url}}">{{$answer->user->name}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>