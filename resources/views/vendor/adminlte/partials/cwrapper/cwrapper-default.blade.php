@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@if($layoutHelper->isLayoutTopnavEnabled())
    @php( $def_container_class = 'container' )
@else
    @php( $def_container_class = 'container-fluid' )
@endif

{{-- Default Content Wrapper --}}
<div class="content-wrapper {{ config('adminlte.classes_content_wrapper', '') }}">

    {{-- Content Header --}}
    @hasSection('content_header')
        <div class="content-header">
            @if ($message = session()->get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <div class="{{ config('adminlte.classes_content_header') ?: $def_container_class }}">
                @yield('content_header')
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <div class="content">
        <div class="{{ config('adminlte.classes_content') ?: $def_container_class }}">
            @stack('content')
            @yield('content')
        </div>
    </div>

</div>
