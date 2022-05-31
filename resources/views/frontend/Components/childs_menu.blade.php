
  @if ($menuParent->childsMenu->count())
  @foreach ($menuParent->childsMenu as $childs  )
        <li>

            @if(trim($childs['name']) == 'Products')
            <a href="{{ route('frontend.product.index') }}">{{ $childs['name'] }}</a>
            @else
            <a href="">{{ $childs['name'] }}</a>
            @endif

            @if ($childs->childsMenu->count())
                 @include('frontend.Components.childs_menu',['menuParent'=>$childs])
            @endif

        </li>

  @endforeach

@endif
