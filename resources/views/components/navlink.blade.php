<li{!! Route::currentRouteName() === $route ? ' class="active"' : '' !!}>
  <a href="{{ route($route, $params) }}">{{ $text }}</a>
</li>
