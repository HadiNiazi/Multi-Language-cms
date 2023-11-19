<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="{{ route('site.home') }}">CMS</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="{{ route('site.home') }}" class="logo me-auto"><img src="{{ asset('assets/site/img/logo.png') }}" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li class="dropdown"><a href="#"><span>{{ __('message.fruits') }}</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                @if (count(fetchAllPublishedFruits(request()->segment(1))) > 0)
                    @foreach (fetchAllPublishedFruits(request()->segment(1)) as $translation)
                            <li><a href="{{ route('site.fruits.details', ['language' => request()->segment(1), 'fruit_id' => $translation->fruit ? $translation->fruit->fruit_id: null]) }}">{{ $translation->fruit ? Str::limit($translation->title_1, 15): '' }}</a></li>
                    @endforeach
                @else
                <ul>
                    <li>
                        <a href="#">No fruit found.</a>
                    </li>
                </ul>
                @endif

                <li><a href="{{ route('site.fruits.details', ['language' => request()->segment(1), request()->segment(2) ? 'fruits': '' ]) }}">{{ __('message.more') }}...</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>{{ __('message.vegetables') }}</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a href="#">Vegetable 1</a></li>
                <li><a href="#">Vegetable 2</a></li>
                <li><a href="#">Vegetable 3</a></li>
                <li><a href="#">{{ __('message.more') }}...</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>{{ __('message.vitamins') }}</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a href="#">Vitamin 1</a></li>
                <li><a href="#">Vitamin 2</a></li>
                <li><a href="#">Vitamin 3</a></li>
                <li><a href="#">{{ __('message.more') }}...</a></li>
            </ul>
          </li>

          <li><a class="nav-link scrollto" href="#contact">{{ __('message.contact') }}</a></li>

          {{-- @dd(request()->is('site.language.item', [request()->segment(1), request()->segment(2)])) --}}
          {{-- @if (substr(url()->current(), strrpos(url()->current(), '/') + 1) == 'fruits') --}}

            <li>
                <form method="GET" action="{{ route('site.language.item', [request()->segment(1), 'fruits']) }}" class="flex-parent">
                    <input type="text" name="searched" value="{{ request()->searched }}" id="search-input" class="form-control flex-child" placeholder="{{ __('message.search') }}...">
                    <button class="flex-child btn" id="search-btn"><i class="fas fa-search"></i></button>
                </form>
            </li>

          {{-- @endif --}}

          <li>
                {{-- <select name="language" class="languages-dropdwon language">
                    <option value="" disabled selected>{{ __('message.choose_language') }}</option>
                    @if (count(fetchAllLanguages()) > 0)
                        @foreach (fetchAllLanguages() as $language)
                            <option @selected(request()->language ? request()->language == strtolower($language->code) : strtolower($language->code) == 'eng')  value="{{ strtolower($language->code) }}">{{ $language->name }}</option>
                        @endforeach
                    @endif
                </select> --}}

                <select name="language" class="languages-dropdwon language">
                    <option value="" disabled selected>{{ __('message.choose_language') }}</option>
                    @if (count(fetchAllLanguages()) > 0)
                        @foreach (fetchAllLanguages() as $language)
                            <option @selected(request()->segment(1) ? request()->segment(1) == strtolower($language->code) : strtolower($language->code) == 'eng')  value="{{ strtolower($language->code) }}">{{ $language->name }}</option>
                        @endforeach
                    @endif
                </select>

          </li>


          <!-- list item with multiple childs -->
          {{-- <li class="dropdown"><a href="#"><span>Fruits</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a href="#">Drop Down 1</a></li>
                <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                    <li><a href="#">Deep Drop Down 1</a></li>
                    <li><a href="#">Deep Drop Down 2</a></li>
                    <li><a href="#">Deep Drop Down 3</a></li>
                    <li><a href="#">Deep Drop Down 4</a></li>
                    <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
                </li>
                <li><a href="#">Drop Down 2</a></li>
                <li><a href="#">Drop Down 3</a></li>
                <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li> --}}



          <li>
            @auth
                <a href="{{ route('admin.dashboard') }}" class="btn login-btn">{{ __('message.dashboard') }}</a>
            @else
                <a href="{{ route('login') }}" class="btn login-btn">{{ __('message.login') }}</a>
            @endauth
          </li>

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->


      {{-- <a href="#appointment" class="appointment-btn scrollto"><span class="d-none d-md-inline">Make an</span> Appointment</a> --}}

    </div>
  </header>
