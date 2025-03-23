<div class="home-grid-wrapper style-3">
    <div class="container-fluid p-0">
        @if($grid->name)
            <div class="container">
                <h2 class="home-grid-title text-center mb-5">{{ $grid->name }}</h2>
            </div>
        @endif
        
        @if($grid->description)
            <div class="container">
                <div class="home-grid-description text-center mb-5">
                    {!! $grid->description !!}
                </div>
            </div>
        @endif
        
        <div class="row g-0">
            @foreach($items as $item)
                <div class="col-md-6 col-lg-4 position-relative grid-item-wrapper">
                    <div class="grid-item-overlay position-absolute w-100 h-100 d-flex flex-column justify-content-center align-items-center text-center p-4" 
                         style="{{ $item->bg_color ? 'background-color: ' . $item->bg_color . ';' : 'background-color: rgba(0,0,0,0.7);' }}">
                        
                        @if($item->icon)
                            <div class="grid-item-icon mb-3">
                                <i class="{{ $item->icon }} fa-3x text-white"></i>
                            </div>
                        @endif
                        
                        @if($item->title)
                            <h3 class="grid-item-title text-white">{{ $item->title }}</h3>
                        @endif
                        
                        @if($item->subtitle)
                            <h4 class="grid-item-subtitle text-white-50 mb-3">{{ $item->subtitle }}</h4>
                        @endif
                        
                        @if($item->description)
                            <div class="grid-item-description text-white-50 mb-4">
                                {!! $item->description !!}
                            </div>
                        @endif
                        
                        @if($item->button_text && $item->link)
                            <div class="grid-item-button">
                                <a href="{{ $item->link }}" 
                                   class="btn btn-{{ $item->button_type ?: 'light' }}"
                                   style="{{ $item->button_color ? 'background-color: ' . $item->button_color . ';' : '' }}">
                                    {{ $item->button_text }}
                                </a>
                            </div>
                        @elseif($item->link)
                            <div class="grid-item-link">
                                <a href="{{ $item->link }}" class="text-white">{{ $item->link_text ?: 'Learn More' }} →</a>
                            </div>
                        @endif
                    </div>
                    
                    @if($item->image)
                        @include('plugins/home-grid::includes.image', ['item' => $item, 'attributes' => ['class' => 'img-fluid w-100 h-100 object-fit-cover', 'alt' => $item->title]])
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>