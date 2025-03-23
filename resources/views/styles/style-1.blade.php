<div class="home-grid-wrapper style-1">
    <div class="container">
        @if($grid->name)
            <h2 class="home-grid-title">{{ $grid->name }}</h2>
        @endif
        
        @if($grid->description)
            <div class="home-grid-description">
                {!! $grid->description !!}
            </div>
        @endif
        
        <div class="row">
            @foreach($items as $item)
                <div class="col-md-4 mb-4">
                    <div class="grid-item" style="{{ $item->bg_color ? 'background-color: ' . $item->bg_color . ';' : '' }}">
                        @if($item->title || $item->subtitle || $item->description || ($item->button_text && $item->link))
                            <div class="grid-item-content">
                                @if($item->icon)
                                    <div class="grid-item-icon">
                                        <i class="{{ $item->icon }}"></i>
                                    </div>
                                @endif
                                
                                @if($item->title)
                                    <h3 class="grid-item-title">{{ $item->title }}</h3>
                                @endif
                                
                                @if($item->subtitle)
                                    <h4 class="grid-item-subtitle">{{ $item->subtitle }}</h4>
                                @endif
                                
                                @if($item->description)
                                    <div class="grid-item-description">
                                        {!! $item->description !!}
                                    </div>
                                @endif
                                
                                @if($item->button_text && $item->link)
                                    <div class="grid-item-button">
                                        <a href="{{ $item->link }}" 
                                           class="btn btn-{{ $item->button_type ?: 'primary' }}"
                                           style="{{ $item->button_color ? 'background-color: ' . $item->button_color . ';' : '' }}">
                                            {{ $item->button_text }}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endif
                        
                        @if($item->image)
                            <div class="grid-item-image">
                                @if($item->link && !($item->button_text && $item->link))
                                    <a href="{{ $item->link }}">
                                @endif
                                
                                @include('plugins/home-grid::includes.image', ['item' => $item, 'attributes' => ['class' => 'img-fluid', 'alt' => $item->title]])
                                
                                @if($item->link && !($item->button_text && $item->link))
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>