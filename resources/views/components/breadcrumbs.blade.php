@if(isset($breadcrumbs) && count($breadcrumbs) > 0)
  <ol class="breadcrumb">
    @foreach($breadcrumbs as $breadcrumb)
      @if($breadcrumb === end($breadcrumbs))
        <li class="active">
          {{ $breadcrumb['text'] }}
        </li>
      @else
        <li>
          <a href="{{ $breadcrumb['url'] }}">
            {{ $breadcrumb['text'] }}
          </a>
        </li>
      @endif
    @endforeach
  </ol>
@endif
