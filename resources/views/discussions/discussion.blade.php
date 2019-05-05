<div class="discussion @if ($discussion->unReadCount() > 0) unread @endif">

  <div class="avatar"><img src="{{route('users.cover', [$discussion->user, 'small'])}}" class="rounded-circle"/></div>
  <div class="content w-100">

    <div class="d-flex justify-content-between align-items-start">
      <span class="name">
        <a href="{{ route('groups.discussions.show', [$discussion->group, $discussion]) }}">
          {{ $discussion->name }}
        </a>
      </span>






    </div>




    <div class="tags">
      @if ($discussion->tags->count() > 0)
        @foreach ($discussion->tags as $tag)
          <span class="badge tag">{{$tag->name}}</span>
        @endforeach
      @endif
    </div>

    <div class="summary">
      <a href="{{ route('groups.discussions.show', [$discussion->group, $discussion]) }}">
        {{summary($discussion->body) }}
      </a>
    </div>

    <div class="meta">
      {{trans('messages.started_by')}}
      <span class="user">
        <a href="{{ route('users.show', [$discussion->user]) }}">{{ $discussion->user->name}}</a>
      </span>
      {{trans('messages.in')}} {{ $discussion->group->name}} {{ $discussion->created_at->diffForHumans()}}
    </div>
  </div>


  <div class="comment-count">
    @if ($discussion->unReadCount() > 0)
      <div class="badge-unread">{{ $discussion->unReadCount() }}</div>
    @else
      <div class="d-flex align-self-center">{{ $discussion->comments_count }} <i class="fa fa-comment-o ml-1" aria-hidden="true"></i></div>
    @endif
  </div>






  @can('update', $discussion)
    <div class="ml-4 dropdown">
      <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-cog" aria-hidden="true"></i>
      </button>


      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
        @can('update', $discussion)
          <a class="dropdown-item" href="{{ route('groups.discussions.edit', [$discussion->group, $discussion]) }}">
            <i class="fa fa-pencil"></i>
            {{trans('messages.edit')}}
          </a>
        @endcan

        <a class="dropdown-item" up-modal=".dialog" href="{{ route('groups.tags.edit', [$discussion->group, 'discussions', $discussion]) }}">
          <i class="fa fa-tags"></i> {{_('Edit tags')}}
        </a>

        @can('delete', $discussion)
          <a up-modal=".dialog" class="dropdown-item" href="{{ route('groups.discussions.deleteconfirm', [$discussion->group, $discussion]) }}">
            <i class="fa fa-trash"></i>
            {{trans('messages.delete')}}
          </a>
        @endcan

      </div>
    </div>
  @endcan

</div>
